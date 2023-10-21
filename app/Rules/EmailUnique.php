<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmailUnique implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $email;
    public function __construct($email)
    {
        $this->email=$email;
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
        $count =  User::select('id')->where("email",'like',$value)->first();

        if($count) {
            $fail("Email is already taken");
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
