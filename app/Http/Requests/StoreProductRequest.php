<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "barcode" => [
                "required", "string", "min:6", "max:16", "unique:products,barcode"
            ],
            "image" => [
                "required", "image", "mimes:jpg,jpeg,png,svg,gif,jfif", "max:10240"
            ],
            "name" => ["required", "string", "min:2", "max:100", "unique:products,name"],
            "description" => ["nullable", "string", "max:255"],
            "tax_percentage" => ["required", "numeric", "min:0" , "max:50"],
            "profit_percentage" => ["required", "numeric", "min:0" , "max:50"],
            "gross_price" => ["required", "numeric"],
            "stock" => ["required", "numeric"],
        ];
    }
}
