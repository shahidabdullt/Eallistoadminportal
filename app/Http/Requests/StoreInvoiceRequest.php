<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
    public function rules()
    {
        $rules=[
            'user_id'=>['required'],
            'date'=>['nullable','date'],
            'amount'=>['nullable','numeric'],
            'status'=>['required','in:Unpaid,Paid,Cancelled'],
        ];
        
        if($this->isMethod('post')){
            dd(10);
            $rules['user_id']=['required'];
        }
        elseif($this->isMethod('put')){
            $rules['username']=['required','exists:users,username'];
        }
        return $rules;
    }

  
}
