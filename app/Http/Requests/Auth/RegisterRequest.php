<?php

namespace App\Http\Requests\Auth;
use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
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
            'full_name' => 'required|string|min:3|max:300',
            'email' => 'required|string|email|unique:users,email|min:3|max:100',
            'password' => 'required|string|min:6|max:20'
        ];
    }


    public function messages()
    {
        return [
            'email.unique' => 'This email address is already taken. Please try another one.',
        ];
    }
}
