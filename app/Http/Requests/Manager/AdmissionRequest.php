<?php

namespace App\Http\Requests\Manager;

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
            'cycle' => 'required|integer|min:1|max:3',
            'type' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'session_admission' => 'required|string',
            'link' => 'required|active_url',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'detail_program_id' => __('id programme'),
            'start_at' => __('date de début d\'admission'),
            'start_at' => __('date de début d\'admission'),
            'link' => __('lien d\'admission'),
            'end_at' => __('date fin d\'admission'),
        ];
    }
}
