<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');

        return [
            'full_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', Rule::unique('users', 'user_name')->ignore($userId)],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'is_admin'  => ['required', 'in:0,1'],
            'is_active' => ['nullable', 'boolean'],
            'password'  => ['nullable', 'string', 'min:8'],
            'image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            
        ];
    }
}
