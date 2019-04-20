<?php

namespace App\Exceptions;

class AppUnprocessableException extends AppException
{
    /**
     * @var int
     */
    protected $statusCode = 401;
}
