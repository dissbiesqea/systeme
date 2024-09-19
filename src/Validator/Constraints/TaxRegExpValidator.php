<?php

namespace App\Validator\Constraints;

use App\Enum\TaxEnum;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxRegExpValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxRegExp) {
            throw new UnexpectedTypeException($constraint, TaxRegExp::class);
        }

        if (!TaxEnum::getFromRegExpCheck($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
