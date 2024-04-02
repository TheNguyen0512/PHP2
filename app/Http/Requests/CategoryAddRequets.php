<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequets extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cate_name'=>'required|unique:categories|min:2|max:255'
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