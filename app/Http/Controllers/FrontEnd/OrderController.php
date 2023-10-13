<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\topping;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use App\Models\orderitem;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Branch;
use App\Models\ProductStock;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();
        $toppings = topping::all();
        return view('orders.index',compact("products","toppings"));
    }

    public function orderView()
    {
        $toppings = topping::all();
        $branches = Branch::all();
        return view('orders.viewOrder',compact("toppings","branches"));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log::info($request->all()); // Log the entire request data

        $orderItemsData = $request->input('orderData')['order_items'];
        $branchId = $request->input('orderData')['branch_id'];
        // Create a new order
        $order = new Order();
        $order->customer_id = auth()->user()->id; 
        $order->order_date = now(); 
        $order->status = 'Pending'; // Default status
        $order->save();

        // Get the order ID
        $orderId = $order->id;

        // Store order items and calculate the total price
    
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($orderItemsData as $itemData) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $itemData['product_id'];
            $orderItem->topping_id = $itemData['topping_id'];
            $orderItem->serving = $itemData['serving'];
            $orderItem->quantity = $itemData['quantity'];
            $orderItem->save();
            
            // Calculate the subtotal for each order item and add it to the total price
            $subtotal = ($orderItem->quantity * $itemData['price']) + $itemData['topping_price']; // Assuming you have a 'price' column in the 'products' table
            $totalPrice += $subtotal;
            $totalQuantity += $orderItem->quantity;   
        }
        
        // Set the calculated total price for the order
        $order->price = $totalPrice;
        $order->quantity = $totalQuantity;
        $order->branch_id = $branchId;
        $order->save();

        return response()->json(['message' => 'Order created successfully', 'order_id' => $orderId]);
    }

    public function checkout(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    
        $orderId = $request->input('order_id');
        $orderItems = OrderItem::where('order_id', $orderId)->get();
    
        $lineItems = [];
        foreach ($orderItems as $orderItem){
            $product = Product::find($orderItem->product_id);
    
            // Get the topping name and price if topping_id is not null
            $toppingName = '';
            $toppingPrice = 0; // Initialize topping price to 0
            if (!is_null($orderItem->topping_id)) {
                $topping = Topping::find($orderItem->topping_id);
                $toppingName = $topping->name;
                $toppingPrice = $topping->price;
            }
    
            // Append topping name to product name if it exists
            $productName = $product->name . ($toppingName ? ' with ' . $toppingName : '');
    
            // Calculate the unit amount, including the product price and topping price
            $unitAmount = ($product->price + $toppingPrice) * 100; // Convert to cents
    
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $productName,
                    ],
                    'unit_amount' => $unitAmount,
                ],
                'quantity' => $orderItem->quantity,
            ];
        }
    
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success',[], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' =>  route('checkout.cancel',[], true),
            'metadata' => [
                'order_id' => $orderId, 
            ],
        ]);
    
        return redirect($checkout_session->url);
    }
    

    
    public function success(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
    
        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
    
            $orderId = $session->metadata->order_id;
    
            // Retrieve the order based on the order ID
            $order = Order::find($orderId);
    
            if (!$order) {
                throw new NotFoundHttpException;
            }
    
            // Update the order status to "Paid"
            $order->status = 'Paid';
            $order->save();

            //store payment
            $payment = new Payment();
            $payment->order_id = $orderId; 
            $payment->payment_date = now(); 
            $payment->payment_method = 'Card'; // Default method
            $payment->save();

             // Reduce product stocks
            $this->reduceProductStocks($orderId);
    
            return view('orders.checkout-success');

        } catch (\Exception $e) {
            throw new NotFoundHttpException;
        }
    }

    public function reduceProductStocks($orderId) {
        $orderItems = OrderItem::where('order_id', $orderId)->get();
    
        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->product_id;
            $quantity = $orderItem->quantity;
    
            // Retrieve the branch_id from the orders table
            $order = Order::find($orderId);
            $branchId = $order->branch_id;
    
            // Find the product stock entry for the specific product and branch
            $productStock = ProductStock::where('product_id', $productId)
                ->where('branch_id', $branchId)
                ->first();
    
            if ($productStock) {
                // Reduce the product stock quantity by the quantity ordered
                $productStock->quantity -= $quantity;
    
                // Save the updated product stock entry
                $productStock->save();
            }
        }
    }
    
    

    public function cancel(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


}
