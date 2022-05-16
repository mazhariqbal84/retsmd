<?php

namespace App\libs\Response;


class GlobalApiResponseCodeBook{

    const SUCCESS = [
        'outcome' => 'SUCCESS',
        'outcomeCode' => 200
    ];

    const NOT_AUTHORIZED = [
        'outcome' => 'NOT_AUTHORIZED',
        'outcomeCode' => 401
    ];

    const INVALID_FORM_INPUTS = [
        'outcome' => 'INVALID_FORM_INPUTS',
        'outcomeCode' => 400
    ];

    const INVALID_CREDENTIALS = [
        'outcome' => 'INVALID_CREDENTIALS',
        'outcomeCode' => 400
    ];

    const NOT_LOGGED_IN = [
        'outcome' => 'NOT_LOGGED_IN',
        'outcomeCode' => 401
    ];

    const RECORD_ALREADY_EXIST = [
        'outcome' => 'RECORD_ALREADY_EXIST',
        'outcomeCode' => 5
    ];

    const RECORD_NOT_EXIST = [
        'outcome' => 'RECORD_NOT_EXIST',
        'outcomeCode' => 6
    ];

    const FILE_NOT_EXIST = [
        'outcome' => 'FILE_NOT_EXIST',
        'outcomeCode' => 7
    ];

    const INTERNAL_SERVER_ERROR = [
        'outcome' => 'INTERNAL_SERVER_ERROR',
        'outcomeCode' => 500
    ];

    const ACCESS_DENIED = [
        'outcome' => 'ACCESS_DENIED',
        'outcomeCode' => 401
    ];

    const OLD_CUSTOMER = [
        'outcome' => 'OLD_CUSTOMER',
        'outcomeCode' => 11
    ];

    const TOKEN_EXPIRED = [
        'outcome' => 'TOKEN_EXPIRED',
        'outcomeCode' => 12
    ];
    const ACCOUNT_NOT_VARIFIED = [
        'outcome' => 'ACCOUNT_NOT_VARIFIED',
        'outcomeCode' => 13
    ];
    const PROFILE_NOT_COMPLETE = [
        'outcome' => 'PROFILE_NOT_COMPLETE',
        'outcomeCode' => 14
    ];
    const PROFILE_COMPLETED = [
        'outcome' => 'PROFILE_COMPLETED',
        'outcomeCode' => 15
    ];
    const FAILED = [
        'outcome' => 'FAILED',
        'outcomeCode' => 16
    ];

}
