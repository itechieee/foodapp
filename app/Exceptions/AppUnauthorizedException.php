<?php

namespace App\Exceptions;

class AppUnauthorizedException extends AppException
{
    /**
     * @var int
     */
    protected $statusCode = 401;
}
