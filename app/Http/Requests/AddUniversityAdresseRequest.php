<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUniversityAdresseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
            [
            'university_id' => 'required|integer|exists:universities,id|unique:addresses,university_id',
            'code_postal' => 'nullable|max:10',
            'adress' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'university_id.unique' => 'Cette université possède déjà une adresse enregistrée',
        ];
    }
}
