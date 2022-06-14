<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
                "required", "string", "min:6", "max:16", "unique:products,barcode," . $this->product->id
            ],
            "image" => $this->hasFile("image") ? [
                "image", "mimes:jpg,jpeg,png,svg,gif,jfif", "max:10240"
            ] : ["nullable"],
            "name" => [
                "required", "string", "min:2", "max:100", "unique:products,name," . $this->product->id
            ],
            "description" => ["nullable", "string", "max:255"],
            "tax_percentage" => ["required", "numeric", "min:0", "max:50"],
            "profit_percentage" => ["required", "numeric", "min:0", "max:50"],
            "gross_price" => ["required", "numeric", "min:1"],
            "stock" => ["required", "numeric"],
        ];
    }
}
