<?php

namespace App\Http\Controllers\Admin;

use App\Models\product;
use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        $products = product::all();
        // return response()->json($products);
        return view('admin.products.index',compact("products","messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = Message::all();
        $categories = category::all();
        return view('admin.products.create',compact("categories","messages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('public', $imageName);
        $product=Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'price' => $request->price
        ]);

        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return to_route('admin.products.index')->with('success', 'Product created successfully.');
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
    public function edit(product $product)
    {
        $messages = Message::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        $image = $product->image;
        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public', $imageName);

            $product->update([
                'image' => $imageName
            ]);

        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return to_route('admin.products.index')->with('success', 'product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(product $product)
    // {
    //     Storage::delete($product->image);
    //     $product->categories()->detach();
    //     $product->delete();

    //     return to_route('admin.products.index')->with('danger', 'Product deleted successfully.');
    // }

    public function destroy(Request $request)
    {
        $product = Product::findorfail($request->id);
        $product->categories()->detach();
        $product->delete();

        return response()->json('product deleted successfully');
    }
}
