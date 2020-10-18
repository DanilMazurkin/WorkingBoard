<?php

namespace App\Http\Requests\Fio;

use Illuminate\Foundation\Http\FormRequest;

class FormFio extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'patronymic' => ['required', 'string']
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Поле имя должно быть заполнено.',
            'surname.required' => 'Поле фамилия должно быть заполнено.',
            'patronymic.required' => 'Поле отчество должно быть заполнено.'
        ];
    }
}
