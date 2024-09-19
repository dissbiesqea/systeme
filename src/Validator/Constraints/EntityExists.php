<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EntityExists extends Constraint
{
    public string $message = 'The value "{{ value }}" does not exist in the database.';
    public string $entityClass;
    public string $field;

    public function __construct(?string $entityClass = null, ?string $field = null, ?string $message = null)
    {
        $this->entityClass = $entityClass;
        $this->field = $field;
        $this->message = $message ?? $this->message;
        parent::__construct();
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
