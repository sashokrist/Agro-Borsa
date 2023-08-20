<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:255',
            'amount' => 'required|numeric|between:0,99',
            'quantity' => 'required',
            'price' => 'required|numeric|between:0,99.99',
//            'location' => 'required|min:3|max:255',
        ];
    }
}
