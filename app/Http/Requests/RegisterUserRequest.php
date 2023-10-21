<?php

namespace App\Http\Requests;

use App\Rules\EmailUnique;
use App\Rules\Password;
use App\Rules\UserFullName;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            "firstName"=>[
                'required','string',
                new UserFullName($this->get('firstName'))
            ],
            "lastName"=>[
                'bail',
                'required',
                'string',
                new UserFullName($this->get('lastName'))
            ],

            "email"=>['required',new EmailUnique($this->get('email')),'email',],
            "password"=>['required','string',
                new Password($this->get('password'))]
        ];
    }
}
