<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElasticIp\UpdateRequest;
use App\Http\Resources\ElasticIpResource;
use App\Models\ElasticIpAddress;
use Illuminate\Http\Request;

class UserElasticIpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $elastic_ip = ElasticIpAddress::where(["customer_id" => $request->user["uuid"]])->get();

        return response(ElasticIpResource::collection($elastic_ip));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$elastic_ip = ElasticIpAddress::where(["customer_id" => $request->user["uuid"], "subscription_id" => $id])->first()) {
            return response("", 410);
        }

        return response(new ElasticIpAddress($elastic_ip));
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

        $elastic_ip = $request->getElasticIp();

        $elastic_ip->update($validated);

        return response("");
    }
}
