<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'brand_id.required' => 'The Brand name is required',
            'company_id.required'  => 'A Company name is required',
            'model_no.required'  => 'The model number for car is required',
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
            'registration_num' => 'required | max:15',
            'model_no' => 'required',
            'brand_id' => 'required',
            'company_id' => 'required',
            'parking_mode' => 'required',
            'driver_duty' => 'required',
            'tax_token_expiry_date' => 'required | date',
            'fitness_expiry_date' => 'required | date',
            'insurance_expiry_date' => 'required | date',
            'road_permit_expiry_date' => 'required | date',
            'driver_name' => 'required | alpha_spaces',
            'driver_nid' => 'nullable | numeric',
            'driver_address' => 'required',
            'driver_phone_num' => 'required | numeric'
        ];
    }
}
