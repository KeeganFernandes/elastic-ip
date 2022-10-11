<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessConcentrator\UpdateRequest;
use App\Http\Resources\AccessConcentratorResource;
use App\Models\AccessConcentrator as ModelsAccessConcentrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessConcentrator extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $access_concentrator = ModelsAccessConcentrator::where(["customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->get();

        return response(AccessConcentratorResource::collection($access_concentrator));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$access_concentrator = ModelsAccessConcentrator::where(["customer_id" => request()->user()?->uuid, "site_id" => $id])->whereNotNull("customer_id")->first()) {
            return response("", 410);
        }

        return response(new AccessConcentratorResource($access_concentrator));
    }

    public function pool_assigment(UpdateRequest $request)
    {
        $validated = $request->validated();

        $access_concentrator = $request->getAccessConcentrator();

        $ip_pools = $validated["ip_pools"];

        if (filled($ip_pools)) {
            DB::transaction(function () use($access_concentrator, $ip_pools)
            {
                $access_concentrator->ip_pools->detach();

                $access_concentrator->ip_pools->attach($ip_pools);
            });
        } else {
            $access_concentrator->ip_pools->detach();
        }

        return response("", 200);
    }
}
