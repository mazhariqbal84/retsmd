<?php

namespace App\Http\Requests\Auth;
use App\Http\Requests\BaseRequest;

class OtpVerifiedRequest extends BaseRequest
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
            'email' => 'required|string|email',
            'code' => 'required|min:4|max:4',
        ];
    }


    public function messages()
    {
        return [
            'email.*' => 'Please enter valid email',
            'code.required'  => 'Please enter valid OTP',
        ];
    }
}
