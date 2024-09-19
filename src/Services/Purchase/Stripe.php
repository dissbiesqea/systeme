<?php

namespace App\Services\Purchase;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class Stripe implements PurchaseInterface
{
    public function __construct(
        private readonly StripePaymentProcessor $stripePaymentProcessorInternal,
    ) {
    }

    public function pay(string $sum): bool
    {
        return $this->stripePaymentProcessorInternal->processPayment($sum);
    }
}
