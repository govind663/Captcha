<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

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
                'user_type' =>'required|numeric|max:255',
                'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ];
        }else{
            $rule = [
                'name' => 'required|string|min:4|max:255',
                'user_type' =>'required|numeric|max:255',
                'email' => 'required|string|email|max:255|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => __('Username is required.'),
            'name.string' => __('Invalid name format'),
            'name.min' => __('The length of name must be at least 4 characters'),
            'name.max' => __('The length of name can not exceed 255 characters'),

            'user_type.required' => __('User type is required'),
            'user_type.numeric' => __('User type must be numeric'),
            'user_type.max' => __('User type must be max 255'),

            'email.required' => __('Email Id is required'),
            'email.unique' => __('This email has already been registered'),
            'email.email' => __('Please enter a valid Email address'),

            'password.required' => __('Password is required'),
            'password.confirmed' => __('Passwords do not match'),
            'password_confirmation.required' => __('Confirm Password is required'),
        ];
    }
}
