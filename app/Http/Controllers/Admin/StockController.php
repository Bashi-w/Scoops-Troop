<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ProductStock;
use App\Models\Message;
use App\Models\Product;
use App\Models\Branch;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedbranch = Session::get('selectedBranch');
        $branch = Branch::find($selectedbranch);
        $stocks = ProductStock::where('branch_id', $selectedbranch)
        ->join('products', 'product_stocks.product_id', '=', 'products.id')
        ->select('product_stocks.*', 'products.name as product_name')
        ->get();

        // Format the data for the chart
        // $labels = $stocks->pluck('product_name');
        $productNames = Product::pluck('name')->toArray();

         // Create an array to store quantities, initialized with zeros
        $quantities = array_fill(0, count($productNames), 0);

        foreach ($stocks as $stock) {
            $index = array_search($stock->product_name, $productNames);
            if ($index !== false) {
                $quantities[$index] = $stock->quantity;
            }
        }

        // Retrieve products that are not in stock for the selected branch
        $productsNotInStock = Product::whereDoesntHave('stocks', function ($query) use ($branch) {
            $query->where('branch_id', $branch->id);
        })->select('id', 'name')->get();

        // Get products with stock quantities less than 3
        $lowStockProducts = Product::whereHas('stocks', function ($query) use ($selectedbranch) {
            $query->where('branch_id', $selectedbranch)
                ->where('quantity', '<', 3);
        })->get();
       
        $notInStock = Product::whereDoesntHave('stocks', function ($query) use ($branch) {
            $query->where('branch_id', $branch->id);
        })->select('id', 'name')->get();
        
        // Define an array of colors (you can customize these)
        $productColors = [ 
            '#FFB6C1', // Light Pink
            '#FFD700', // Gold
            '#98FB98', // Pale Green
            '#ADD8E6', // Light Blue
            '#FFA07A', // Light Salmon
            '#FFC0CB', // Pink
            '#B0E0E6', // Powder Blue
            '#F0E68C', // Khaki
            '#87CEEB', // Sky Blue
            '#20B2AA', // Light Sea Green
        ];

        
        $messages = Message::all();
        return view('admin.products.stock', compact('productNames', 'quantities', 'messages', 'branch', 'productsNotInStock','stocks','productColors', 'lowStockProducts','notInStock'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $selectedbranch = Session::get('selectedBranch');

        $data = new ProductStock;
        $data->branch_id= $selectedbranch;
        $data->product_id=$request->product;
        $data->quantity=$request->quantity;
        $data->save();

        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $stockId = $request->input('stockid');
        $stock = ProductStock::findOrFail($stockId);

        $stock->quantity = $request->input('stockQuantity');

        $stock->save();
        Session::flash('success', 'Stock updated successfully.');
        return redirect('/admin/stock');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($stockId)
    {
        $stock = ProductStock::find($stockId); // Use 'find' to get the stock by ID
        
        if (!$stock) {
            // Handle the case where the stock item is not found
            // You can redirect with an error message or handle it as needed
            // Example: return redirect()->back()->with('error', 'Stock item not found.');
        }
        
        $stock->delete();
        
        // Optionally, you can add a flash message here
        Session::flash('stock_delete_success', 'Stock item deleted successfully.');
        
        return redirect()->back();
    }

    
}
