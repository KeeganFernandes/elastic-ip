<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\CreateRequest;
use App\Http\Resources\ElasticIpAddressAssignmentResource;
use App\Jobs\ConfigMikrotik;
use App\Models\AccessConcentrator;
use App\Models\ElasticIpAddressAssignment;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function assignment(CreateRequest $request)
    {
        $validated = $request->validated();

        $validated["access_concentrator_id"] = AccessConcentrator::where(["subscription_id" => $validated["access_concentrator_id"]])->first()->id;

        $elastic_ip_assignment = ElasticIpAddressAssignment::create($validated);

        ConfigMikrotik::dispatch($elastic_ip_assignment);

        return response(new ElasticIpAddressAssignmentResource($elastic_ip_assignment));
    }

    public function recommit()
    {
        ConfigMikrotik::dispatch();
    }
}
