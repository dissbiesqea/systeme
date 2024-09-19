<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxRegExp extends Constraint
{
    public string $message = 'The value "{{ value }}" incorrect.';

    public function __construct(?string $message = null)
    {
        $this->message = $message ?? $this->message;
        parent::__construct();
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
