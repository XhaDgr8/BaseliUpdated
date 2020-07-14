<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordUpdateRequest extends FormRequest
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
            'word' => 'required|string|max:100',
            'countary' => 'required|string|max:100',
            'language' => 'required|string|max:100',
            'meaning' => 'required|string|max:100',
            'defination' => 'required|string',
            'word' => 'required|string|max:100',
            'countary' => 'required|string|max:100',
            'language' => 'required|string|max:100',
            'meaning' => 'required|string|max:100',
            'defination' => 'required|string',
        ];
    }
}
