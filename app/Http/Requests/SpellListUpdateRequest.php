<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpellListUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|min:3',
            'description' =>  'sometimes|nullable|string|min:3',
            'notes' => 'sometimes|string|nullable',
            'list_type' => 'sometimes|required|string|min:3',
        ];
    }
}
