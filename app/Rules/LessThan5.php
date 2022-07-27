<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class LessThan5 implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {

        if (filesize($value->path()) > 5242880 ) {
            $fail('The :attribute filesize is 5mb.');
        }
    }
}
