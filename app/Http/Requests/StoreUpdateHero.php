<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateHero extends FormRequest
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
        $url = $this->segment(2);

        return [
            'name'  => 'required|string|min:3|max:80|unique:heroes',
            'alias' => "required|string|min:3|max:80|unique:heroes,alias,{$url},url",
            'power' => 'required|string|max:100',
        ];
    }
}
