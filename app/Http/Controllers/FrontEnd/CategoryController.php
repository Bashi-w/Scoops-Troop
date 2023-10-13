<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topping;
use App\Models\Product;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $user = Auth()->user();
        if(!$user){
            Auth::logout();
            return view('auth.login');
        }
        else{
            return view('categories.index', compact('categories'));
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category, Topping $topping, Product $product)
    {
        $toppings = Topping::all();
        $products = Product::all();
        $storedBranch = Session::get('selectedBranch');
        
        // Filter branches by region
        $branch = Branch::find($storedBranch)->first();
        
        return view('categories.show', compact('category', 'products', 'toppings', 'branch', 'storedBranch'));
    }
    

}
