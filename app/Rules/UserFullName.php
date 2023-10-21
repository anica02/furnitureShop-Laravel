<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\Rule;

class UserFullName implements InvokableRule
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
        $regName="/^[A-ZĆČĐŽŠ]{1}[a-zćčđžš]{2,15}(\s[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,15})*$/";

        if(!preg_match($regName,$value)) {
            $fail("User name has to start with one uppercase letter and length has to be at least 3 characters");
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
