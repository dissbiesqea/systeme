<?php

namespace App\Validator\Constraints;

use App\Enum\PaymentProcessorEnum;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PaymentProcessorEnumChoice extends Constraint
{
    public string $message = 'The value "{{ value }}" is not a valid option. Please select: ';

    public function __construct(?string $message = null)
    {
        $this->message = $message ?? $this->message.implode(', ', array_column(PaymentProcessorEnum::cases(), 'value'));
        parent::__construct();
    }
}
