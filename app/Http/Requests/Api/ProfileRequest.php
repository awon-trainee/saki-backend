<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => 'nullable|sometimes|email|unique:beneficiaries,email,'.auth()->id(),
            'name'  => 'required|string|max:255',
            'material_status' => 'required|in:single,widower,divorced,married',
            'monthly_income' => 'required|integer',
            'income_source' => 'required|string'
        ];
    }
}
