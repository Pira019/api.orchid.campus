<?php

namespace App\Http\Requests\Manager;

use App\Rules\CheckRoleRule;
use Illuminate\Foundation\Http\FormRequest;

class AddUserVideoKeyRequest extends FormRequest
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
            'user_name' => [
                'required',
                'string',
                "unique:user_video_keys,user_name",
                new CheckRoleRule

            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_name' =>  $this->route('user_name') ,
        ]);
    }
}
