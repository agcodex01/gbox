<?php

namespace App\Http\Requests;

use App\Traits\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    use UniqueRule;
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
            'code' => 'required|unique:products,code' . $this->getUniqueRule($this->product),
            'name' => 'required|min:2',
            'description' => 'sometimes|min:2',
            'category' => 'required',
            'price' => 'required|integer|min:1',
            'board_id' => 'required_without:items|nullable|exists:boards,id',
            'estimate' => 'sometimes|integer',
            'customer_id' => 'required|exists:customers,id',
            'items' => 'sometimes|array'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Please select a valid customer.',
            'board_id.exists' => 'Selected board not exists.',
        ];
    }

}
