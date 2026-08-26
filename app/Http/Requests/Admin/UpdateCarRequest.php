<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'    => ['required', 'exists:categories,id'],
            'title'          => ['required', 'string', 'max:255'],
            'content'        => ['required', 'string'],
            'luggage'        => ['required', 'integer', 'min:0'],
            'doors'          => ['required', 'integer', 'min:1'],
            'passengers'     => ['required', 'integer', 'min:1'],
            'price'          => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'], //to make sure it less than the current price
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active'      => ['nullable', 'boolean'],
            'status'         => ['required', 'string', 'in:available,rented,maintenance'],
        ];
    }
}
