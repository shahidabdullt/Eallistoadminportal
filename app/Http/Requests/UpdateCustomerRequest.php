<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
    {   $userid= (int) $this->route('userid');

      Log::info('Route parameter debug', [
            
            'userid_raw' => $userid,
            'userid_int' => (int) $userid,
            'route_name' => $this->route()->getName(),
            'route_uri' => $this->route()->uri()
        ]);
     
        return [
            'username'=>['required'],
            'address'=>['nullable'],
            'mobile'=>['nullable','digits_between:7,15'],
            'email'=>['nullable','email',Rule::unique('users')->ignore($userid)],
        ];
    }
}
