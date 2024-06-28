<?php

namespace App\Http\Requests\Frontend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
                'email' => 'required|string|email|max:255|exists:users,email'.$this->id,
                'password' => 'required|string',
            ];
        }else{
            $rule = [
                'email' => 'required|string|email|max:255|exists:users,email',
                'password' => 'required|string|min:8',
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'email.required' => __('Email is required'),
            'email.exists' => __('Email does not exist'),
            'email.unique' => __('Email already exists'),
            'email.string' => __('Email must be string'),
            'email.email' => __('Email must be email'),
            'email.max' => __('Email must be max 255'),

            'password.required' => __('Password is required'),
            'password.min' => __('Password must be min 8'),
            'password.string' => __('Password must be string'),
        ];
    }
}
