<?php

namespace App\Http\Requests\Manager;

use App\Repository\Manager\DisciplinarySectorRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => 'required|integer',
            'year' => 'required|date_format:Y|after_or_equal:' . date("Y"),
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

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // dump($validator->safe()->all());
        $validator->after(function ($validator) {
            $ids = explode(',', $validator->safe()->service_disciplinaries);
            $errors = $this->checkDiscplineSectionId($ids);
            if ($errors) {
                $errorId = implode(',', $errors);
                $validator->errors()->add('service_disciplinaries', __("Le valeur du champ disciplines ($errorId) est invalide "));
            }
        });
    }

    public function checkDiscplineSectionId(array $service_disciplinaryIds)
    {
        $getIds = DisciplinarySectorRepository::getDisciplinaryIds($service_disciplinaryIds)->toArray();
        $diff = array_diff($service_disciplinaryIds, $getIds);

        return $diff ?? false;

    }
}
