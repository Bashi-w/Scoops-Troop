<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return response()->json($branches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user= auth()->user(); 

        if (!$user->tokenCan('admin')) {
            abort(403, 'You do not have permission to create a branch.');
        } 

        $data = new Branch();
        $data->id = $request->id;
        $data->location = $request->location;
        $data->save(); 
        
        return response()->json('branch added successfulyy');
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
    public function edit(Request $request)
    {
        $data = Branch::findorfail($request->id);
        $data->id = $request->id;
        $data->location = $request->location;
        $data->update(); 

        return response()->json('branch edited successfulyy');

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
    public function destroy(Request $request)
    {
        $data = Branch::findorfail($request->id)->delete();

        return response()->json('branch deleted successfulyy');
    }
}
