<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CaptchaRequest extends FormRequest
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
                'captcha' => 'required|captcha',
            ];
        }else{
            $rule = [
                'captcha' => 'required|captcha',
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'captcha.required' => 'Please verify the captcha to proceed.',
            'captcha.captcha' => 'The captcha is incorrect.',
        ];
    }
}
