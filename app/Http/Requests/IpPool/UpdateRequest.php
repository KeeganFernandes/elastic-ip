<?php

namespace App\Http\Requests\IpPool;

use App\Models\IpPool;
use App\Rules\IpRangeCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $ip_pool;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->ip_pool = IpPool::where(["id" => request("ip_pool"), "customer_id" => request()->user()?->uuid])->whereNotNull("customer_id")->first()) {
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
            "range_start" => ["required_with:range_end", "ipv4", new IpRangeCheckRule()],
            "range_end" => ["required_with:range_start", "ipv4"], // rule for start and end
        ];
    }

    public function getIpPool()
    {
        return $this->ip_pool;
    }
}
