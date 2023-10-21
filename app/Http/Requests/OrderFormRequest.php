<?php

namespace App\Http\Requests;


use App\Rules\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderFormRequest extends FormRequest
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
            "address"=>[
                'required','string', new Address($this->get("address"))
            ],
            "payment"=>['required','string', Rule::in(['card', 'cash'])],
            "delivery"=>'required|string',
        ];
    }
}
