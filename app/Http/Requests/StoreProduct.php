<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name' => 'required|min:2|max:155',
            'description' => 'required|min:2|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'product name',
            'description' => 'product description',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute is required',
            'description.required' => 'The :attribute is required',
        ];
    }
}
