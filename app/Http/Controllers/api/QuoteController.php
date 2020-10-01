<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Resources\Quote as QuoteResource;
use App\Quote;
use Illuminate\Http\Request;
use PDF;


class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'service_id' => ['required'],
            'email' => ['required'],
            'message' => ['required'],

        ]);

        $customerExist = Customer::where('email', $request->email)->first();
        if ($customerExist) {
            $quote = new Quote();
            $quote->customer_id = $customerExist->id;
            $quote->service_id = $request->service_id;
            $quote->message = $request->message;
            $quote->save();
            return response()->json([
                'Status' => 'Quote Added, Customer Already Exists',
            ], 201);

        } else {
            //saving Customer
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->save();

            //saving quote
            $quote = new Quote();
            $quote->customer_id = $customer->id;
            $quote->service_id = $request->service_id;
            $quote->message = $request->message;
            $quote->save();

            return response()->json([
                'Status' => 'Customer Created & Quote Added',
            ], 201);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        if (is_null($quote)) {
            return response()->json('Item Not Found', 404);
        }
        $quote->delete();
        return response()->json("Deleted Successfully!!", 200);
    }
//==============================================================================
    public function responseSend(Request $request , $id)
    {


        //storing response in response table with customer id, Quote ID
        //pdf making from request
        //extracting email from id of customer
        //sending mail to customer email with pdf attachment
        $quote = Quote::where('id',$id)->first();
        $customer = $quote->customer;
        \error_log($customer);
        $name=$customer->name;
        $phone=$customer->phone;
        $email=$customer->email;
        $price=$request->price;
        $descreption=$request->description;
        $service=$request->service;
        $pdf = PDF::loadView('pdf',compact('name','phone','email','price','service','descreption'));
        return $pdf->download('invoice.pdf');


    }

    public function customerQuotes($id){

        return response()->json([
            'quote' => QuoteResource::collection(Quote::where('customer_id', $id)->get()),
        ], 200);
    }

}
