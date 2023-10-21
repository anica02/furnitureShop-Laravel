<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\Rule;

class Password implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $password;
    public function __construct($password)
    {
        $this->password=$password;
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
        $regPass="/^(?=.*[a-zčćđžš])(?=.*[A-ZČĆĐŽŠ])(?=.*\d)(?=.*[@$!%*?])([A-ZČĆĐŽŠa-zčćđžš\d@$!%*?]){8,}$/";

        if(!preg_match($regPass,$value)) {
            $fail("Password length has to be at least 8 character and has to contain at least one uppercase letter, one lowercase, one number and one special character");
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
