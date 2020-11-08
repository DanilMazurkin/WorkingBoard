<?php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;

class FormAd extends FormRequest
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
            'image' => ['mimes: bmp,png, jpg'],           
            'header' => ['required', 'string'],
            'text' => ['required', 'string']
        ];
    }

    public function messages() {
        return [
            'image.mimes' => 'Изображение должно быть типа bmp, png, jpg',
            'header.required' => 'Заголовок необходим для заполнения',
            'text.required' => 'Текст необходим для заполнения'
        ];
    }
}
