<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;


class Address implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $address;
    public function __construct($address)
    {
        $this->address=$address;
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
        $regAddress='/^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{0,15})*\s[\d]{1,5}(\s[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,15})*,(\s[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,10})+\s[\d]{5}$/';

        if(!preg_match($regAddress,$value)) {
            $fail("Address is not entered in a good form");
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
