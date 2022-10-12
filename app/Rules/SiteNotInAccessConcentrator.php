<?php

namespace App\Rules;

use App\Models\AccessConcentrator;
use Illuminate\Contracts\Validation\Rule;

class SiteNotInAccessConcentrator implements Rule
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
        if (AccessConcentrator::where(["site_id" => $value])->first()) {
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
        return 'Site cannot be an access concentrator.';
    }
}
