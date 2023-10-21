<?php

namespace App\Http\Requests;

use App\Rules\ProductName;
use App\Rules\ProductNameUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductInsertRequest extends FormRequest
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
                new ProductName($this->get("name")), 'unique:products,name'
            ],
            "price"=>'required|numeric|min:1',
            "color"=>'required|exists:colors,id',
            "category"=>'required|exists:categories,id',
            "material"=>'required|exists:materials,id',
            "image"=>'required|image|mimes:jpg,png|max:2080',
            "discountFilter"=>[
                    Rule::in(['0','1', '2','3']),
             ],
            "discountPrice"=>['bail','nullable','numeric','min:1', 'required_unless:discountFilter,0'],
        ];
    }
}
