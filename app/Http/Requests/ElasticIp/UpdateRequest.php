<?php

namespace App\Http\Requests\ElasticIp;

use App\Models\ElasticIpAddress;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $elastic_ip;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->elastic_ip = ElasticIpAddress::where(["subscription_id" => request("elastic_ip"), "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first()) {
            return false;
        }

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
            "name" => ["string", "max:100"],
            "ptr_record" => ["nullable", "string"],
        ];
    }

    public function getElasticIp()
    {
        return $this->elastic_ip;
    }
}
