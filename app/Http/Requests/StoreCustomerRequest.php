<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules=[
            'username'=>['required'],
            'address'=>['nullable'],
            'mobile'=>['nullable','digits_between:7,15'],
            'email'=>['nullable','email']
        ];
      
      
       

        return $rules;
    }
   
}
