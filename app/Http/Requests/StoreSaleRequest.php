<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
        return array_merge([
            "cashier.id" =>  ["required", "exists:users,id"],

            "customer.name"  => ['nullable', "string"],
            "customer.id"  => ['nullable', "exists:customers,id"],

            "customer_pay_money" => ["required", 'numeric',],

            "discount" => ["nullable", "numeric"],

            "products" => ["required", "array"],
            "products.*.id" => ['required', "exists:products,id"],
            "products.*.stock" => ['required', "numeric"],
            "products.*.quantity" => ['required', "numeric"],
        ]);
    }
}
