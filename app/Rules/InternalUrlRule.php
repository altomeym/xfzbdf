<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InternalUrlRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $url = request()->getHttpHost();
        if (preg_match('/('.$url.')\/(\S+)?/', $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute url must start with '. request()->getHttpHost();
    }
}