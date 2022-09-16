<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:40',
            'image' => 'image|max:2048|mimes:jpg,png,svg,webp,jpeg',
            'description' => 'nullable|string|max:100',
            'slug' => 'string',
            'is_active' => 'boolean',
        ];
    }
}
