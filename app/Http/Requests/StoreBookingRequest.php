<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'car_id'        => ['required', 'exists:cars,id'],
            'pick_up_date'  => ['required', 'date', 'after_or_equal:today'],
            'drop_off_date' => ['required', 'date', 'after:pick_up_date'],
        ];
    }
}
