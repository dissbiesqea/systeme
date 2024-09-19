<?php

namespace App\Exception;

class ErrorMessageException extends \RuntimeException
{
    public function __construct(string $message = 'Unexpected error! Please contact support.')
    {
        parent::__construct($message);
    }
}
