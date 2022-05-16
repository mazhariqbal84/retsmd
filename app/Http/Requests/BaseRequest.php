<?php

namespace App\Http\Requests;

use App\libs\Response\GlobalApiResponse;
use App\libs\Response\GlobalApiResponseCodeBook;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ApiException
     */

    protected function failedValidation(Validator $validator) {
        $errors = (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS,'Oops, an error occurred..!', $validator->errors()->all());
        throw new HttpResponseException(response()->json($errors, 200));
    }

}
