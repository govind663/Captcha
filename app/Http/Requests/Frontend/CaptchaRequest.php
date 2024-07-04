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
        //  increment wrong count
        $this->incrementCaptchaCount(false);

        throw new ValidationException($validator);
    }

    protected function incrementCaptchaCount(bool $isWrong)
    {
        //  get wrong count
        $wrongCount = CaptchaCount::where('citizen_id', Auth::user()->id)->first();
        if ($wrongCount) {
            if ($isWrong) {
                $wrongCount->is_wrong_captcha_count = $wrongCount->is_wrong_captcha_count + 1;
            } else {
                $wrongCount->is_wrong_captcha_count = $wrongCount->is_wrong_captcha_count + 1;
            }
            $wrongCount->save();
        } else {
            CaptchaCount::create([
                'citizen_id' => Auth::user()->id,
                'is_wrong_captcha_count' => $isWrong ? 0 : 1, //  if correct then 1 else 0
                'inserted_at' => Carbon::now(),
                'inserted_by' => Auth::user()->id,

            ]);
        }

    }
}
