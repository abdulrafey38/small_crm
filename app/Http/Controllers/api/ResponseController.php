<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Response;

class ResponseController extends Controller
{
    public function show($id)
    {
        \error_log('hjyug');
        $response = Response::where('quote_id',$id)->get();
        return response()->json([
            'quoteResponse'=>$response
        ],200);
    }
}
