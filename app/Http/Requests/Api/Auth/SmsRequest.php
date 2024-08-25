<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class SmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $phone = $this->input('phone');
        try {
            $normalized_phone = new PhoneNumber($phone, 'SA');
            $this->merge(['phone' => $normalized_phone->formatE164()]);
        }
            // in case phone number is invalid, do nothing and let the validation rules deal with it
        catch (\Exception $e) {

        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string|starts_with:+9665|exists:beneficiaries,phone',
            'sms' => 'required|string|min:4|max:4'
        ];
    }
}
