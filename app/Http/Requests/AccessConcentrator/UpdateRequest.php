<?php

namespace App\Http\Requests\AccessConcentrator;

use App\Models\AccessConcentrator;
use App\Models\IpPool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected $access_concentrator;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->access_concentrator = AccessConcentrator::where(["id" => request("access_concentrator_id"), "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first()) {
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
            "ip_pools" => ["required", "array", "max:50"],
            "ip_pools.*" => ["required", Rule::exists(IpPool::class, "id")] // where customer id
        ];
    }

    public function getAccessConcentrator()
    {
        return $this->access_concentrator;
    }
}
