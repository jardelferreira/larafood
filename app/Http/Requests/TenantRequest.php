<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'cnpj' => "required|string|max:20|unique:tenants,cnpj,{$this->segment(3)},id",
            'name' => "required|string|min:3|max:255|unique:tenants,email,{$this->segment(3)}},id",
            'logo' => 'required|mimes:jpeg,png,jpg|max:1014',
            'plan_id' => "required",
            'email' => "required|email|max:255|unique:tenants,email,{$this->segment(3)}},id"
        ];
        if ($this->method() == "PUT") {
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg|max:1014';
        }
        return $rules;
    }
}
