<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class BeneficiariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'              => 'required|string|min:5|max:255',
            'email'             => 'nullable|sometimes|string|email|unique:beneficiaries,email,' . $this->id,
            'phone'             => 'required|string|phone:SA|unique:beneficiaries,phone,' . $this->id,
            'nationality_id'    => 'required|integer|exists:countries,id',
            'gender'            => 'nullable|string|in:male,female',
            'material_status'   => 'nullable|string|in:married,single,divorced,widower',
            'monthly_income'    => 'nullable|integer',
            'income_source'     => 'nullable|string|max:255',
            'id_number'         => 'required|numeric|digits:10|unique:beneficiaries,id_number,' . $this->id,
        ];

        if (backpack_user()->type == User::ADMIN) {
            $rules['user_id'] = 'required|integer|exists:users,id';
        } else {
            $rules['user_id'] = 'prohibited';
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_id' => trans('backpack::base.roles.charity'),
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
