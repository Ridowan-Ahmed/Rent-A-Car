<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class LogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'log_date.before' => "You can't add log for future",
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'log_date' => 'required | before:tomorrow',
            'octane_starting_km' => 'nullable | numeric',
            'octane_ending_km' => 'nullable | numeric | min: 0',
            'diesel_starting_km' => 'nullable | numeric',
            'diesel_ending_km' => 'nullable | numeric | min: 0',
            'cng_starting_km' => 'nullable | numeric',
            'cng_ending_km' => 'nullable | numeric | min: 0',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'payment_amount' => 'nullable | numeric',
            'payment_reason' => 'nullable | alpha_spaces',
        ];
    }
}
