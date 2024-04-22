<?php

namespace App\Http\Requests\Manager\Service;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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

    protected function prepareForValidation(){
        $this->merge([
            'id' => $this->route('service')
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
            'id' => 'required|integer|exists:services',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => __('Id service est invalide'),
        ];
    }
}
