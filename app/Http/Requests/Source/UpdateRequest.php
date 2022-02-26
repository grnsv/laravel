<?php

namespace App\Http\Requests\Source;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'url'         => ['required', 'url', 'max:255'],
            'title'       => ['nullable', 'string', 'max:255'],
            'link'        => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Необходимо заполнить поле :attribute'
        ];
    }
}
