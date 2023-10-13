<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = product::all();
        $users = user::all();
        return view('home',compact("products","users"));
    }

    public function destroy($id)
    {
        $user = User::find($id);  
        $user->delete();
        return Redirect::to('/');
    }
}
