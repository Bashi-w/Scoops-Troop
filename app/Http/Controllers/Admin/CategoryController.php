<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        $categories = category::all();
        return view('admin.categories.index',compact("categories","messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = Message::all();
        return view('admin.categories.create',compact("messages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request)
    {
       // $image = $request->file('image')->store('public/categories');
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('public', $imageName);
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return to_route('admin.categories.index')->with('success', 'Category created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        $messages = Message::all();
        return view('admin.categories.edit', compact('category','messages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $category->image;
        if ($request->hasFile('image')) {
            Storage::delete($category->image);

            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public', $imageName);

            $category->update([
                'image' => $imageName
            ]);

        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return to_route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        Storage::delete($category->image);
        $category->products()->detach();
        $category->delete();

        return to_route('admin.categories.index')->with('danger', 'Category deleted successfully.');
    }
}
