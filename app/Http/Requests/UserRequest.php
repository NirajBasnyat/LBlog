<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'email' => 'required| email |max:254',
            'password' => 'required|min:8',
            'role' => 'required',
            'permissions.*' => 'integer',
            'permissions' => 'required|array',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['password'] = ['nullable'];
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}