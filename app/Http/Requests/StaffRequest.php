<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'role' => 'required',
            'address' => 'sometimes',
            'email' => 'required|email:dns',
            'phone' => 'sometimes',
            'password' => Rule::when(
                $this->method() == 'POST',
                'required|min:8|confirmed',
            )
        ];
    }
}
