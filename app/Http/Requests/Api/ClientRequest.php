<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => "required|min:5|max:60|string",
            'email' => "required|email|unique:clients",
        ];
        if ($this->method() == "POST") {
            $rules['password'] = "required|min:5|max:15";
        }
        return $rules;
    }
}