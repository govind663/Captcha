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
                'email' => 'required|email|max:255|exists:citizens,email'.$this->id,
                'amount' => 'required|numeric|min:0',
                'bank_name' => 'required|string|max:250',
                'bank_branch' => 'required|alpha_dash|string|max:250',
                'account_holder_name' => 'required|string|max:250',
                'account_number' => 'required|alpha_num|max:16',
                'ifsc_code' => 'required|alpha_num|max:11',
                'payment_mode' => 'required|numeric|max:3',
                'transaction_date' =>'required|date_format:Y-m-d',
                'transaction_time' =>'required|date_format:H:i',
            ];
        }else{
            $rule = [
                'citizen_id' => 'required|numeric|max:5',
                'email' => 'required|email|max:255|unique:citizens,email,NULL,id,deleted_at,NULL',
                'amount' => 'required|numeric|min:0',
                'bank_name' => 'required|string|max:250',
                'bank_branch' => 'required|alpha_dash|string|max:250',
                'account_holder_name' => 'required|string|max:250',
                'account_number' => 'required|alpha_num|max:16',
                'ifsc_code' => 'required|alpha_num|max:11',
                'payment_mode' => 'required|numeric|max:3',
                'transaction_date' =>'required|date_format:Y-m-d',
                'transaction_time' =>'required|date_format:H:i',
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'citizen_id.required' => 'Citizen Name is required',
            'citizen_id.numeric' => 'Citizen Name must be numeric',
            'citizen_id.max' => 'Citizen Name must be max 5',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.max' => 'Email must be max 255',
            'email.exists' => 'Email must be unique',

            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be numeric',
            'amount.min' => 'Amount must be minimum 0',

            'bank_name.required' => 'Bank Name is required',
            'bank_name.string' => 'Bank Name must be string',
            'bank_name.max' => 'Bank Name must be max 250',

            'bank_branch.required' => 'Bank Branch is required',
            'bank_branch.alpha_dash' => 'Bank Branch must be alphanumeric with dash',
            'bank_branch.string' => 'Bank Branch must be string',
            'bank_branch.max' => 'Bank Branch must be max 250',

            'account_holder_name.required' => 'Account Holder Name is required',
            'account_holder_name.string' => 'Account Holder Name must be string',
            'account_holder_name.max' => 'Account Holder Name must be max 250',

            'account_number.required' => 'Account Number is required',
            'account_number.alpha_num' => 'Account Number must be alphanumeric',
            'account_number.max' => 'Account Number must be max 16',

            'ifsc_code.required' => 'IFSC Code is required',
            'ifsc_code.alpha_num' => 'IFSC Code must be alphanumeric',
            'ifsc_code.max' => 'IFSC Code must be max 11',

            'payment_mode.required' => 'Payment Mode is required',
            'payment_mode.numeric' => 'Payment Mode must be numeric',
            'payment_mode.max' => 'Payment Mode must be max 3',

            'transaction_date.required' => 'Payment Date is required',
            'transaction_date.date_format' => 'Payment Date must be in Y-m-d format',

            'transaction_time.required' => 'Payment Time is required',
            'transaction_time.date_format' => 'Payment Time must be in H:i format',
        ];
    }

    // ==== transaction_date
    public function passesTransactionDate($attribute, $value){
        $date = DateTime::createFromFormat('Y-m-d', $value);
        return $date && $date->format('Y-m-d') === $value;
    }
}
