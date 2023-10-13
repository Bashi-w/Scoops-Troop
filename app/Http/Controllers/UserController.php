<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Branch;


class UserController extends Controller
{
    /**
     * Display a listing of
     *  the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        $selectedbranch = Session::get('selectedBranch');
        $branch = Branch::find($selectedbranch);
        $orderCount = Order::where('customer_id', $user->id)->where('branch_id', $selectedbranch)->count();
        $unpaidOrders = Order::where('customer_id', $user->id)->where('status', 'Pending')->where('branch_id', $selectedbranch)->count();
        $cancelledOrders = Order::where('customer_id', $user->id)->where('status', 'Cancelled')->where('branch_id', $selectedbranch)->count();
        $paidOrders = Order::where('customer_id', $user->id)->where('status', 'Paid')->where('branch_id', $selectedbranch)->count();

        $totalPrice = Order::where('customer_id', $user->id)
        ->where('status', 'Paid')
        ->where('branch_id', $selectedbranch)
        ->sum('price');


        // Query to get the number of orders for each month
        $ordersperMonth = Order::where('customer_id', $user->id)
        ->where('branch_id', $selectedbranch)
        ->selectRaw('YEAR(order_date) as year, MONTH(order_date) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

         // Prepare data for the line chart
        $labels = [];
        $data = [];

        foreach ($ordersperMonth as $orderperMonth) {
            $monthYear = date('M Y', strtotime($orderperMonth->year . '-' . $orderperMonth->month . '-01'));
            $labels[] = $monthYear;
            $data[] = $orderperMonth->count;
        }

        
        if ($orderCount == 0) {
            $abandonRate = null; // or any other default value you prefer
        } else {
            $abandonRate = ($unpaidOrders / $orderCount) * 100;
        }
        
        $abandonRate = number_format($abandonRate, 1);

        $orders = Order::where('customer_id', $user->id)->where('branch_id', $selectedbranch)->get();
         // Find the most ordered product
        $mostOrderedProduct = $this->findMostOrderedProduct($orders);

        // $order_items = Order::where('customer_id', $user->id)
        //         ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        //         ->select('order_items.product_id', 'order_items.topping_id', 'order_items.quantity','order_items.serving')
        //         ->get();

        $orderItems = OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
        })->with('product', 'topping')->get();


        return view('profile', compact('orderCount','totalPrice','abandonRate','labels', 'data','cancelledOrders','paidOrders','unpaidOrders','orders', 'mostOrderedProduct', 'orderItems','branch'));
        // return view('profile', compact('orders', 'productNames', 'toppingNames'),);
    }

    private function findMostOrderedProduct($orders)
{
    $productCount = [];

    // Iterate through each order and its items
    foreach ($orders as $order) {
        $orderItems = $order->orderItems;

        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->product_id;
            $quantity = $orderItem->quantity;

            // Increment the count for this product by its quantity
            if (isset($productCount[$productId])) {
                $productCount[$productId] += $quantity;
            } else {
                $productCount[$productId] = $quantity;
            }
        }
    }

    // Check if the $productCount array is empty
    if (empty($productCount)) {
        return null; 
    }

    // Find the product with the highest count
    $mostOrderedProductId = array_search(max($productCount), $productCount);

    // Retrieve the product details
    $mostOrderedProduct = Product::find($mostOrderedProductId);

    return $mostOrderedProduct;
}



    public function getOrderItems($orderId)
{
    $order = Order::find($orderId);
    
    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    // Load the order items associated with the order
    $orderItems = $order->orderItems;

    // Initialize an array to store product and topping details
    $orderItemDetails = [];

    // Iterate through each order item to retrieve product and topping details
    foreach ($orderItems as $orderItem) {
        $product = Product::find($orderItem->product_id);
        $topping = Topping::find($orderItem->topping_id);

        // Add the product and topping details to the array
        $orderItemDetails[] = [
            'product_name' => $product ? $product->name : 'N/A',
            'topping_name' => $topping ? $topping->name : '',
            'quantity' => $orderItem->quantity,
            
        ];
    }

    // Return the order item details as a JSON response
    return response()->json($orderItemDetails);
}


public function cancelOrder(Request $request){
    $orderId = $request->input('order_id');
    $order = Order::find($orderId);
    
    if ($order) {
        $order->status = "Cancelled";
        $order->save(); // Call the save method
    }

    Session::flash('success', 'Order Cancelled.');
    return redirect()->back();
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ...
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ...
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('edituser');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'house' => 'required',
            'street' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            //'password' => 'required|min:8|confirmed'
        ]);
        
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'house'=> $request->house,
            'street'=> $request->street,
            'city'=> $request->city,
            'email'=> $request->email,
            //'password' => Hash::make($request->password)
        ]);
        Session::flash('success', 'Profile updated successfully!');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Auth::logout();
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }
}
