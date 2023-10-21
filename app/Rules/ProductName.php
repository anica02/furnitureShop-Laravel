<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\InvokableRule;

class ProductName implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $name;
    public function __construct($name)
    {
        $this->name=$name;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function __invoke($attribute, $value, $fail)
    {
        $regex='/^[A-Z]{1}[A-Za-z0-9]{2,}(\s[A-Z]{1}[A-Za-z0-9]{2,})*$/';

        if(!preg_match($regex,$value)) {
            $fail("Product name must start with uppercase letter");
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
