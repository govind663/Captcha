<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->id){
            $rule = [
                'name' => 'required|string|min:4|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$this->id.'|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'user_type' =>'required|numeric',
            ];
        }else{
            $rule = [
                'name' => 'required|string|min:4|max:255',
                'email' => 'required|string|email|max:255|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'user_type' =>'required|numeric',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'name.min' => __('Name must be min 4'),
            'name.max' => __('Name must be max 255'),

            'email.required' => __('Email is required'),
            'email.exists' => __('Email does not exist'),
            'email.unique' => __('Email already exists'),
            'email.string' => __('Email must be string'),
            'email.email' => __('Email must be email'),
            'email.max' => __('Email must be max 255'),
            'email.regex' => __('Email must be valid'),

            'user_type.required' => __('User type is required'),
            'user_type.numeric' => __('User type must be numeric'),
            'user_type.max' => __('User type must be max 255'),

            'password.required' => __('Password is required'),
            'password.min' => __('Password must be min 8'),
            'password.string' => __('Password must be string'),
            'password_confirmation.required' => __('Password confirmation is required'),
            'password_confirmation.same' => __('Password confirmation does not match'),
        ];
    }
}
