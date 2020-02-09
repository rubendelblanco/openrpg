<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpellStoreRequest extends FormRequest
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
            'name'       => 'required|string|min:3',
            'description'          =>  'required|string|min:3',
            'level'    =>  'required|integer|min:1',
            'list_name' => 'required|string|min:3',
            'code' => 'required|string|min:1',
            'class' => 'required|string|min:1',
            'subclass' => 'required|string|min:1',
            'effect_area' => 'required|string|min:5',
            'duration' => 'required|string|min:5',
            'range' => 'required|string|min:5',
            'notes' => 'string|nullable',
            'list_id' => 'nullable|integer|exists:spell_lists,id',
        ];
    }
}
