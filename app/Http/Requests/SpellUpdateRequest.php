<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpellUpdateRequest extends FormRequest
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
            'name'       => 'sometimes|string|min:3',
            'description'          =>  'sometimes|string|min:3',
            'level'    =>  'sometimes|integer|min:1',
            'list_name' => 'sometimes|string|min:3',
            'code' => 'sometimes|string|min:1',
            'class' => 'sometimes|string|min:1',
            'subclass' => 'sometimes|string|min:1',
            'effect_area' => 'sometimes|string|min:5',
            'duration' => 'sometimes|string|min:5',
            'range' => 'sometimes|string|min:5',
            'notes' => 'string|nullable',
            'list_id' => 'nullable|sometimes|integer|exists:spell_lists,id',
        ];
    }
}
