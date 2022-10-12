<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpPool\CreateRequest;
use App\Http\Requests\IpPool\UpdateRequest;
use App\Http\Resources\IpPoolResource;
use App\Models\IpPool;
use Illuminate\Http\Request;

class IpPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ip_pool = IpPool::where(["customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->get();

        return response(IpPoolResource::collection($ip_pool));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        $ip_pool = IpPool::create($validated);

        return response(new IpPoolResource($ip_pool), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $ip_pool = IpPool::where(["uuid" => $id, "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first();

        if (!$ip_pool) {
            return response("", 410);
        }

        return response(new IpPoolResource($ip_pool));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $ip_pool = $request->getIpPool();
    
        $ip_pool->update($validated);

        return response("");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ip_pool = IpPool::where(["uuid" => $id, "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first();

        if (!$ip_pool) {
            return response("", 410);
        }

        $ip_pool->delete();

        return response("", 204);
    }
}
