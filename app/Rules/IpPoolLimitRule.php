<?php

namespace App\Rules;

use App\Models\IpPool;
use Illuminate\Contracts\Validation\Rule;

class IpPoolLimitRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (IpPool::where(["customer_id" => $value])->get()->count() > 200) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User as exceeded there ip pool limit.';
    }
}
