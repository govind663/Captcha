<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\CaptchaCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
                'captcha_code' => 'required|captcha|captcha:' . $this->id,
            ];
        }else{
            $rule = [
                'captcha_code' => 'required|captcha',
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'captcha_code.required' => 'Please verify the captcha to proceed.',
            'captcha_code.captcha' => 'The captcha is incorrect.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $this->incrementCaptchaCount(false);

        throw new ValidationException($validator);
    }

    protected function incrementCaptchaCount(bool $isWrong)
    {
        if ($isWrong) {
            //  create new wrong Count
            $wrongCount = new CaptchaCount();
            $wrongCount->citizen_id = Auth::user()->id;
            $wrongCount->captcha_id = null;
            $wrongCount->is_wrong_captcha_count = 1;
            $wrongCount->is_correct_captcha_count = 0;
            $wrongCount->per_captcha_amount = 0;
            $wrongCount->inserted_at = Carbon::now();
            $wrongCount->inserted_by = Auth::user()->id;
            $wrongCount->save();
        }
    }
}
