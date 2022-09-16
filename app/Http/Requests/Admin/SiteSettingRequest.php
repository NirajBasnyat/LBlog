<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:30|min:5',
            'image' => 'image|max:2048|mimes:jpg,png,svg,webp,jpeg',
            'short_name' => 'string|max:5',
            'description' => 'string|min:10',
            'email' => 'required|email',
            'footer_text' => 'string|max:30',
            'phone_number' => 'required|string|digits:10',
        ];
    }
}
