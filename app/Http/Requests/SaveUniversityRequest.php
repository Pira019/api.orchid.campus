<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUniversityRequest extends FormRequest
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
        return [
            'name' => 'required|unique:universities',
            'city_name' => 'required',
            'country_id' => 'required|integer|exists:countries,id',
            'webSite' => 'required|url:http,https',
            'shortName' => 'nullable|String',
        ];
    }

    public function attributes()
{
    return [
        'name' => 'nom de l\'université',
    ];
}
}
