<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessConcentratorResource;
use App\Models\AccessConcentrator as ModelsAccessConcentrator;
use Illuminate\Http\Request;

class AccessConcentrator extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user;

        $access_concentrator = ModelsAccessConcentrator::where(["customer_id" => $user])->get();

        return AccessConcentratorResource::collection($access_concentrator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user;

        $access_concentrator = ModelsAccessConcentrator::where(["customer_id" => $user, "site_id" => $id])->get();

        return new AccessConcentratorResource($access_concentrator);
    }
}
