<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'nullable',
            'birth' => 'nullable',
        );
        if ($this->method() === 'PUT') {
            $rules['email'] = 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,' . $this->user->id;
            $rules['password'] = 'nullable';
        }
        return $rules;
    }

}
