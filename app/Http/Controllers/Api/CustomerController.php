<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    public function getAllCustomers(){
        $perPage = 5;
        // $data = User::where('is_admin', 0)->get();
        $data = User::where('is_admin', 0)->paginate($perPage);
        return response()->json([
            'customers' => $data
        ],200);
    }

    public function getSingleCustomer($id){
        $customer = User::where('is_admin', 0)->where('id', $id)->get();
        if(!$customer){
            return response()->json([
                'message' => 'Customer Not Found'
            ],404); 
        }

        return response()->json([
            'customer' => $customer
        ],200);
    }

    public function addNewCustomer(StoreCustomerRequest $request){
        try{
            User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'house' => $request->house,
                    'street' => $request->street,
                    'city' => $request->city,
                    'dob' => $request->dob,
                    'password' =>  Hash::make($request->password),
                ]
                );
                return response()->json([
                    'message' => "Customer successfully created"
                ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => "Something went wrong: ",
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCustomer(StoreCustomerRequest $request, $id){
        try {
            // Find customer
            $customer = User::where('is_admin', 0)->find($id);
            
            if (!$customer) {
                return response()->json([
                    'message' => 'Customer Not Found'
                ], 404);
            }
    
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->mobile = $request->input('mobile');
            $customer->house = $request->input('house');
            $customer->street = $request->input('street');
            $customer->city = $request->input('city');
            $customer->dob = $request->input('dob');
            $customer->password = Hash::make($request->input('password'));
    
            $customer->save();
    
            return response()->json([
                'message' => "Customer details updated successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Something went wrong: ",
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
     public function deleteCustomer($id){
        $customer = User::where('is_admin', 0)->find($id);
            
        if (!$customer) {
            return response()->json([
                'message' => 'Customer Not Found'
            ], 404);
        }

        $customer->delete();
        
        return response()->json([
            'message' => "Customer deleted successfully"
        ], 200);

     }
}
