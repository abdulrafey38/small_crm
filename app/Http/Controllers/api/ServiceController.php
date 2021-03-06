<?php

namespace App\Http\Controllers\api;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Service as ServiceResource;

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
            'services' => ServiceResource::collection(Service::all()->sortBy('name')->sortByDesc('created_at')),
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

        $service = new Service();
        $service->name=$request->name;
        $service->budget=$request->budget;
        $service->save();
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

        $service = Service::find($id);

        $request->validate([
            'name' => ['required'],
            'name'=> Rule::unique('services')->ignore($service->id),
        ]);


        if (is_null($service)) {
            return response()->json([
                'Not Found', 400
            ]);
        } else {
            $service->name= $request->name;
            $service->budget= $request->budget;
            $service->save();

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
