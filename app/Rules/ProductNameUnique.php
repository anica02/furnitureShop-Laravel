<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductNameUnique implements InvokableRule
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
        $count =  DB::table("products")->where("name",'=',$value);


        if($count) {
            $fail("Product name is already taken");
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
