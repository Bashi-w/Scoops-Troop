<?php

namespace App\Http\Controllers\Admin;

use App\Models\topping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        $toppings = topping::all();
        return view('admin.toppings.index',compact("toppings","messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = Message::all();
        return view('admin.toppings.create',compact("messages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Topping::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return to_route('admin.toppings.index')->with('success', 'Topping created successfully.');
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
    public function edit(topping $topping)
    {
        $messages = Message::all();
        return view('admin.toppings.edit', compact('topping','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, topping $topping)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price'=>'required'
        ]);

        $topping->update([
            'name' => $request->name,
            'description' => $request->description,
            'price'=> $request->price
        ]);

        return to_route('admin.toppings.index')->with('success', 'Topping updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(topping $topping)
    {
        $topping->delete();

        return to_route('admin.toppings.index')->with('danger', 'Topping deleted successfully.');
    }
}
