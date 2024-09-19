<?php

namespace App\Validator\Constraints;

use App\Enum\PaymentProcessorEnum;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PaymentProcessorEnumChoiceValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PaymentProcessorEnumChoice) {
            throw new UnexpectedTypeException($constraint, PaymentProcessorEnumChoice::class);
        }

        $allowedValues = array_column(PaymentProcessorEnum::cases(), 'value');

        if ($value && !in_array($value, $allowedValues, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->setCode(Choice::NO_SUCH_CHOICE_ERROR)
                ->addViolation();
        }
    }
}
