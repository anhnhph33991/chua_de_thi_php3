<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:products',
            'description' => 'nullable',
            'price' => 'required|max_digits:8|numeric',
            'quantity' => 'required|numeric',
            'is_active' => ['nullable', Rule::in([0, 1])],
            'image' => 'nullable|image|max:2048'
        ];
    }
}
