<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateResquest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        $id = $this->route('id');
        return [
            'cate_name' => [
                'required',
                Rule::unique('categories')->ignore($id,'cate_id'),
                'min:2',
                'max:255'
            ]
        ];
    }

    public function messages()
    {
        return [
            'cate_name.required' => 'Name cannot be blank',
            'cate_name.unique' => 'Names cannot be duplicated',
            'cate_name.max' => 'Name cannot exceed 255 characters',
            'cate_name.min' => 'Name must be greater than 4 characters',
        ];
    }
}
