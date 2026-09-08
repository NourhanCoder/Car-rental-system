<?php

namespace App\Http\Requests\Api\Auth;


use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    use ApiResponse;
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
     * 
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse('Validation Errors', 422, $validator->errors())
        );
        
    }
}
