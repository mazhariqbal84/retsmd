<?php

namespace App\Services;

use App\Traits\AppCommonTrait;
use App\Traits\GlobalErrorHandlingTrait;


/**
 * Class BaseService
 * @package App\Service
 */
class BaseService
{
    use GlobalErrorHandlingTrait,AppCommonTrait;
}