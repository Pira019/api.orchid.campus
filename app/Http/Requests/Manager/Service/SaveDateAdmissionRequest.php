<?php

namespace App\Http\Requests\Manager\Service;

use Illuminate\Foundation\Http\FormRequest;

class SaveDateAdmissionRequest extends FormRequest
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
            'serviceId' =>(int)$this->route('serviceId'),
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
            'serviceId' =>'required|integer|exists:services,id',
            'admissionDateIds' => 'required|array|min:1',
            'admissionDateIds.*' => 'required|integer|distinct|exists:admission_dates,id',
        ];
    }


    public function attributes(): array
    {
        return [
            'admissionDateIds.*' => __('admission (position :position)'),
        ];
    }
}
