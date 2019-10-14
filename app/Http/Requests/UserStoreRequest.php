<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name' => 'required',
            'description' => 'required',
            'url' => 'required'
        ];
    }

    public function messages(){

        return [
            'category_name.required' => 'Category name is required!',
            'description.required' => 'Description is required!',
            'url.required' => 'Url is required!'

        ];
    }
}
