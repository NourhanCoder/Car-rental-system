<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:users,user_name'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'      => ['required', 'in:admin,user'],
            'is_active' => ['nullable', 'boolean'],
            'password'  => ['required', 'string', 'min:8'],
            'image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];
    }
}
