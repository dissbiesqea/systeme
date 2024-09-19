<?php

namespace App\Exception;

class AccessDeniedException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Access denied');
    }
}
