<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'phone' => 'required|phone:SA|unique:users,phone,' . $this->id,
            'password' => 'required|max:255|confirmed',
            'password_confirmation' => 'required|max:255',
            'type' => 'required|in:' . User::ADMIN . ',' . User::CHARITY,
            'charity_name' => 'required_if:type,' . User::CHARITY . '|prohibited_if:type,' . User::ADMIN . '|max:255',
            // 'categories' => 'required_if:type,' . User::CHARITY . '|prohibited_if:type,' . User::ADMIN . '|exists:categories,id',
            // 'categories' => [
            //     'required_if:type,' . User::CHARITY,
            //     'prohibited_if:type,' . User::ADMIN,
            //     function (string $attribute, mixed $value, \Closure $fail) {
            //         $all = $this->request->all();
            //         if (isset($all['type']) && $all['type'] == User::CHARITY)
            //             if (!Category::where('id', $value)->exists())
            //                 $fail();
            //     },
            // ]
            // 'roles' => 'required|array',
        ];

        // Check if the request method is PUT or PATCH
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['type'] = 'prohibited';
        } else {
            $rules['type'] = 'required|in:' . User::ADMIN . ',' . User::CHARITY;
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
            'type' => trans('backpack::base.roles.role'),
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $replacements = [
            'attribute' => trans('validation.attributes.categories'),
            'other' => trans('backpack::base.roles.role'),
        ];
        return [
            'charity_name.required_if' => trans('validation.charity_name_required_if'),
            'charity_name.prohibited_if' => trans('validation.charity_name_prohibited_if'),
            'categories.required_if' => trans(
                'validation.required_if',
                array_merge($replacements, ['value' => trans('backpack::base.roles.charity')])
            ),
            'categories.prohibited_if' => trans(
                'validation.prohibited_if',
                array_merge($replacements, ['value' => trans('backpack::base.roles.admin')])
            ),
        ];
    }
}