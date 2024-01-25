<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTutoVideoRequest extends FormRequest
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
            'name' => 'required',
            'video' => 'required|file|max:200000',
            'isPrivate' => 'required|boolean',
            'tutorial_id' => 'required|exists:tutorials,id',
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
            'isPrivate.required' => 'Veuillez préciser si cette vidéo doit rester privée ou non.',
        ];
    }
 
    protected function prepareForValidation()
    {
        $this->merge([
            'isPrivate' => $this->toBoolean($this->isPrivate) ,
        ]);
    }
  
    private function toBoolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

}
