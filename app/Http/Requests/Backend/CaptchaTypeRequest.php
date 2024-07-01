<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CaptchaTypeRequest extends FormRequest
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
                'type_name' => 'required|string|max:255',
            ];
        }else{
            $rule = [
                'type_name' => 'required|string|max:255',
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'type_name.required' => __('Captcha Type is required'),
            'type_name.string' => __('The Captcha Type must be a string.'),
            'type_name.max' => __('The length of Captcha Type should not exceed 255 characters'),
        ];
    }
}
