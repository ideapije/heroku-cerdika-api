<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogbookStore extends FormRequest
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
            'logbook.*.question_id' => 'required|exists:questions,id',
            'logbook.*.choice_id' => 'required|exists:choices,id'
        ];
    }

    public function messages()
    {
        return [
            'logbook.*.choice_id.required' => 'Wajib diisi'
        ];
    }
}
