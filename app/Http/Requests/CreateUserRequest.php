<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:5',
            'user_type' => 'required|not_in:null',
            'phone' => 'required',
            'city' => 'required',
            'country' => 'required',
            'language' => 'required',
            'language_level' => 'required',
        ];
    }
}
