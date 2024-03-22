<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'price' => 'required|integer',
            'year' => 'required|date_format:Y|after_or_equal:'.date("Y"),
            'country_id' => 'required|exists:cities,country_id',
            'service_disciplinaries' => 'required|regex:/^\d+(,\d+)*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'year.date_format' => 'Le champ année ne correspond pas au bon format Ex: 2022',
        ];
    }

    public function attributes(): array
    {
        return [
            'country_id' => __('pays'),
            'service_disciplinaries' => __('disciplines'),
        ];
    }
}
