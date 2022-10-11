<?php

namespace App\Http\Requests\IpPool;

use App\Rules\IpPoolLimitRule;
use App\Rules\IpRangeCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            "range_start" => ["required", "ipv4", new IpRangeCheckRule()],
            "range_end" => ["required", "ipv4"],
            "customer_id" => ["required", "uuid", new IpPoolLimitRule()]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(["customer_id" => request()->user["uuid"]]);
    }
}
