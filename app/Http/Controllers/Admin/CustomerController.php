<?php

namespace App\Http\Controllers\Admin;

use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        $users = user::all();
        return view('admin.customers.index',compact("users","messages"));
       
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        
        $user = User::find($id);
        $user->delete();

        return to_route('admin.customers.index')->with('danger', 'Customer deleted successfully.');
    }

    public function addressBook(){
        $customers = User::where('is_admin', 0)->get();
        $messages = Message::all();
        return view('admin.customers.addressBook',compact("customers","messages"));
    }

    public function search(Request $request)
{
    if ($request->ajax()) {
        $query = $request->search;

        if (empty($query)) {
            // Return all customers if the search query is empty
            $data = User::where('is_admin', 0)->get();
        } else {
            $data = User::where('is_admin', 0)
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('id', 'like', '%' . $query . '%')
                        ->orWhere('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%');
                })
                ->get();
        }

        $output = '';
        if (count($data) > 0) {
            $output = '
                <table class="table" id="user-table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    
                </tr>
                </thead>
                <tbody>';
            foreach ($data as $row) {
                $output .= '
                <tr class="user-row" data-user-id="' . $row->id . '">
                    <th scope="row">' . $row->id . '</th>
                    <td>' . $row->name . '</td>
                    
                    </tr>
                    ';
            }
            $output .= '
                </tbody>
                </table>';
        } else {
            $output .= 'No results';
        }
        return $output;
    }
}

public function getUserDetails($id)
{
    // Fetch the user details by user ID
    $user = User::find($id);
    $selectedBranch = Session::get('selectedBranch');

    $orderCount = Order::where('customer_id', $id)->where('branch_id', $selectedBranch)->count();

    $unpaidOrders = Order::where('customer_id', $id)->where('status', 'Pending')->where('branch_id', $selectedBranch)->count();
    $cancelledOrders = Order::where('customer_id', $id)->where('status', 'Cancelled')->where('branch_id', $selectedBranch)->count();
    $paidOrders = Order::where('customer_id', $id)->where('status', 'Paid')->where('branch_id', $selectedBranch)->count();

    $totalPrice = Order::where('customer_id', $id)
        ->where('status', 'Paid')
        ->where('branch_id', $selectedBranch)
        ->sum('price');

    // Query to get the number of orders for each month
    $ordersperMonth = Order::where('customer_id', $id)
        ->where('branch_id', $selectedBranch)
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

    $payments = Payment::select('payments.*', 'orders.price')
    ->join('orders', 'payments.order_id', '=', 'orders.id')
    ->whereIn('payments.order_id', function ($query) use ($id, $selectedBranch) {
        $query->select('id')
            ->from('orders')
            ->where('customer_id', $id)
            ->where('branch_id', $selectedBranch);
    })
    ->get();  

    // Load a view to format the user details (create a new view file if needed)
    return view('admin.customers.user_details', compact('user','orderCount','labels', 'data','unpaidOrders','cancelledOrders','paidOrders','totalPrice','payments'));
}


}
