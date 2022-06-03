<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateUserRequest extends FormRequest
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
            "avatar" => $this->hasFile("avatar") ?
                "required|image|mimes:jpg,jpeg,png,svg,gif,jfif|max:2048" : 'nullable',
            "name" => "required|min:2|max:100|string",
            "email" => ["required", 'email', "string", 'max:100'],
            "phone_number" => "required|max:20",
            "address" => "required|max:255",
            "password" => [
                'required', "max:50", "string",
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()
            ],
            "confirm_password" => [
                new RequiredIf(!!$this->input("password")), "same:password"
            ],
            "role" => "required|string",
        ];
    }
}
