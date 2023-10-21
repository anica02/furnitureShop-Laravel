<?php

namespace App\Http\Requests;

use App\Rules\ProductName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            "name"=>[
                'required','string','min:3', 'max:20',
                new ProductName($this->get("name"))
            ],
            "color"=>'required|exists:colors,id',
            "category"=>'required|exists:categories,id',
            "material"=>'required|exists:materials,id',
            "price"=>'required|numeric|min:1',
            "status"=>[
                'required',
                'exists:products,status'
            ],
            "discountFilter"=>[
                Rule::in(['0','1', '2','3']),
            ],

            "discountPrice"=>['bail','nullable','numeric','min:1', 'required_unless:discountFilter,0'],
            "pImage"=>'image|mimes:jpg,png|max:2080'
        ];
    }


}
