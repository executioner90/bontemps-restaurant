<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'image' => ['image', 'nullable'],
            'special' => ['nullable', 'in:on'],
        ];
    }
}
