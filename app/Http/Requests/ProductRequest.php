<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'title' => "required|string|min:3|max:255|unique:products,title,{$this->segment(3)},id",
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'image' => 'required|mimes:jpeg,png,jpg|max:1014',
            'description' => "nullable|string|max:10000"
        ];
        if ($this->method() == "PUT") {
            $rules['image'] = 'nullable|image';
        }
        return $rules;
    }
}
