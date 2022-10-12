<?php

namespace App\Http\Requests\Site;

use App\Models\AccessConcentrator;
use App\Models\ElasticIpAddress;
use App\Rules\SiteNotInAccessConcentrator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    protected $elastic_ip;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->elastic_ip = ElasticIpAddress::where(["subscription_id" => request("subscription_id"), "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first()) {
            return false;
        }

        $this->merge(["elastic_ip_address_id" => $this->elastic_ip->id]);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "elastic_ip_address_id" => ["required"],
            "access_concentrator_id" => ["required", Rule::exists(AccessConcentrator::class, "subscription_id")],
            "site_id" => ["required",  new SiteNotInAccessConcentrator()],
        ];
    }
}
