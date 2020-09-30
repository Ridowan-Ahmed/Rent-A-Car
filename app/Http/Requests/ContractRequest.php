<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'octane_cost' => 'required | numeric',
            'diesel_cost' => 'required | numeric',
            'cng_cost' => 'required | numeric',
            'starting_octane' => 'required | numeric',
            'brand_id' => 'required',
            'car_rent' => 'required | numeric',
            'overtime_cost' => 'required | numeric',
            'breakfast_cost' => 'required | numeric',
            'launch_cost' => 'required | numeric',
            'dinner_cost' => 'required | numeric',
            'contract_type' => 'required',
            'contract_duration' => 'required | numeric',
        ];
    }
}
