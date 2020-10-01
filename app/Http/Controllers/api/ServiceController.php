<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Resources\Service as ServiceResource;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'services' => ServiceResource::collection(Service::all()->sortByDesc('created_at')),
        ], 200);
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
            'name' => ['required','unique:services,name'],
        ]);

        Service::create($request->all());
        return response()->json([
            'Status' => 'Success',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'Message' => 'Item Not Found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'service' => new ServiceResource($service)
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
        \error_log($request->name);

        \error_log($id);
        $request->validate([
            'name' => ['required'],
        ]);

        $service = Service::find($id);
        if (is_null($service)) {
            return response()->json([
                'Not Found', 400
            ]);
        } else {
            $service->update($request->all());
            return response()->json(200);
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
        $service = Service::find($id);
        if (is_null($service)) {
            return response()->json('Service Not Found', 404);
        }
        $service->delete();
        return response()->json("Deleted Successfully!!", 200);
    }
}
