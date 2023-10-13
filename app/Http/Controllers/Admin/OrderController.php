<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\product;
use App\Models\topping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $todayDate = date('Y-m-d');
        $messages = Message::all();
        $selectedBranch = Session::get('selectedBranch');
        $orders = order::where('branch_id', $selectedBranch)->get();
        return view('admin.orders.index',compact("orders","messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = message::all();
        $products = product::all();
        $toppings = topping::all();
        return view('admin.orders.create',compact("products","toppings","messages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Order::create([
            'name' => $request->name,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'order_date' => $request->date,
            'product_id' => $request->product_id,
            'topping_id' => $request->topping_id,
            'serving' => $request->serving
        ]);

        return to_route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        return view('admin.orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        $request->validate([
            //'name' => 'required',
            'status' => 'required',
            //'quantity' => 'required',
            //'order_date'=>'required'
        ]);

        $order->update([
            //'name' => $request->name,
            'status' => $request->status,
            //'quantity'=> $request->quantity,
            //'order_date'=> $request->quantity,
        ]);

        return to_route('admin.orders.index')->with('success', 'Order Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        $order->delete();

        return to_route('admin.orders.index')->with('danger', 'Order deleted successfully.');
    }
}
