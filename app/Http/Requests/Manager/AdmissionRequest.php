<?php

namespace App\Http\Requests\Manager;

use App\Rules\UniqueAddAdmissionCombination;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
            'detail_program_id' => 'required|integer|exists:university_program,id',
            'type' => 'required|string',
            'start_at' => 'required|date|after_or_equal:'.date("Y-m-d"),
            'end_at' => 'required|date|after:start_at',
            'session_admission' => 'required|string',
            'link' => 'required|active_url',
            'year' => 'required|date_format:Y|after_or_equal:'.date("Y"),
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $combinationRule = new UniqueAddAdmissionCombination(
                $this->input('detail_program_id'),
                $this->input('session_admission'),
                $this->input('year')
            );

            if ($combinationRule->passes('unique_combination', null)) {
                return;
            }

            $validator->errors()->add('unique_combination', __("La date du programme,session et de l'année est déjà enregistrée"));
        });
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'detail_program_id' => __('programme id'),
            'start_at' => __('date de début d\'admission'),
            'start_at' => __('date de début d\'admission'),
            'link' => __('lien d\'admission'),
            'end_at' => __('date fin d\'admission'),
            'unique_combination' => __('admission'),
        ];
    }
}
