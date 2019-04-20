<?php

namespace App\Exceptions;

class AppNotFoundException extends AppException
{
    /**
     * @var int
     */
    protected $statusCode = 404;
}
