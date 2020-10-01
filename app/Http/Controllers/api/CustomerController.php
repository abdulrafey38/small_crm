<?php

namespace App\Http\Controllers\api;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::where('is_client',0)->get();
        return response()->json([
            'customers'=>CustomerResource::collection($customers)
            ,200]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, customer with id ' . $id . ' cannot be found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'customer' => new CustomerResource($customer),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json([
                'Not Found', 400
            ]);
        } else {
            $customer->update($request->all());
            return response()->json([
                'updated_customer' => new CustomerResource($customer)
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json('Item Not Found', 404);
        }
        $customer->delete();
        return response()->json("Deleted Successfully!!", 200);
    }


    public function getAllClients()
    {
        //
        $customers = Customer::where('is_client',1)->get();
        return response()->json([
            'clients'=>CustomerResource::collection($customers)
            ,200]);

    }
}
