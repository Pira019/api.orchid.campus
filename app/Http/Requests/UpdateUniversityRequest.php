<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(){
        $this->merge([
            'id' =>(int)$this->route('id'),
            'name' => ucfirst(strtolower($this->input('name')))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:universities',
            'name' => 'required|max:255|unique:universities,name,'. $this->id,
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
