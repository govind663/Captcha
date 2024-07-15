<?php

namespace App\Http\Requests\Frontend;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class CitizenPaymentRequest extends FormRequest
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
                'citizen_id' => 'required|numeric|max:5',
                'per_captcha_amt' => 'required|string',
                'request_amount' => 'required|string',
                'payment_mode' => 'required|numeric|max:3',
                'transaction_date' =>'required|date_format:d-m-Y',
                'transaction_time' =>'required|date_format:H:i',
                'notes' => 'required|string|max:250'
            ];
        }else{
            $rule = [
                'citizen_id' => 'required|numeric|max:5',
                'per_captcha_amt' => 'required|string',
                'request_amount' => 'required|string',
                'payment_mode' => 'required|numeric|max:3',
                'transaction_date' =>'required|date_format:d-m-Y',
                'transaction_time' =>'required|date_format:H:i',
                'notes' => 'required|string|max:250'
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'citizen_id.required' => 'Citizen Name is required',
            'citizen_id.numeric' => 'Citizen Name must be numeric',
            'citizen_id.max' => 'Citizen Name must be max 5',

            'per_captcha_amt.required' => 'Per Captcha Amount is required',
            'per_captcha_amt.string' => 'Per Captcha Amount must be string',

            'request_amount.required' => 'Request Amount is required',
            'request_amount.string' => 'Request Amount must be string',

            'payment_mode.required' => 'Payment Mode is required',
            'payment_mode.numeric' => 'Payment Mode must be numeric',
            'payment_mode.max' => 'Payment Mode must be max 3',

            'transaction_date.required' => 'Payment Date is required',
            'transaction_date.date_format' => 'Payment Date must be in d-m-Y format',

            'transaction_time.required' => 'Payment Time is required',
            'transaction_time.date_format' => 'Payment Time must be in H:i format',

            'notes.required' => 'Notes is required',
            'notes.string' => 'Notes must be string',
            'notes.max' => 'Notes must be max 250',
        ];
    }
}
