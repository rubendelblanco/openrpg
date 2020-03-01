<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route()->parameter('user');
        return [
            'name' => 'sometimes|required|min:4',
            'email' => "sometimes|required|email|unique:users,email,{$user->id}",
            'password' => 'sometimes|same:repeat_password|min:8',
            'repeat_password' => 'sometimes|same:password|min:8'
        ];
    }
}
