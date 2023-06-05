<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompany extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        $uuid = $this->company;

        return [
            'hero_id' => 'required|exists:heroes,id',
            'name' => "required|string|min:2|max:100|unique:companies,name,{$uuid},uuid",
            'email' => "required|email|max:100|unique:companies,email,{$uuid},uuid",
            //'image' => 'nullable|image|max:1024',
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image', 'max:1024'];
        }

        return $rules;
    }
}
