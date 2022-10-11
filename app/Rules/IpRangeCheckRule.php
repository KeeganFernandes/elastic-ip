<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IpRangeCheckRule implements Rule
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
        $range_end = request("range_end") ?? 0;

        if (request("range_start") > $range_end) {
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
        return 'range_start cannot be greater than range_end.';
    }
}
