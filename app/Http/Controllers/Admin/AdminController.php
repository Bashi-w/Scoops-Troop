<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Topping;
use App\Models\User;
use App\Models\Order;
use App\Models\Message;

class AdminController extends Controller
{
    public function index()
    {

        $messages = Message::all();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalToppings = Topping::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('is_admin','0')->count();
        $totdalAdmin = User::where('is_admin','1')->count();
        $totalMessages = Message::count();

        $todayDate = date('Y-m-d');
        $month = date('m');
        $year = date('Y');
        
        $totalOrders = Order::count();
        $todayOrders = Order::whereRaw('DATE(created_at) = ?', [$todayDate])->count();
        $ordersThisMonth = Order::whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ?', [$month, $year])->count();
        $ordersThisYear = Order::whereRaw('YEAR(created_at) = ?', [$year])->count();
 

        return view('admin.index',compact('totalProducts','totalCategories','totalToppings','totalAllUsers','totalUser','totdalAdmin','totalOrders','todayOrders','ordersThisMonth','ordersThisYear','messages','totalMessages'));

    }
}
