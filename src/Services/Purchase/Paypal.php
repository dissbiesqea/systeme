<?php

namespace App\Services\Purchase;

use App\Exception\ErrorMessageException;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class Paypal implements PurchaseInterface
{
    public function __construct(
        private readonly PaypalPaymentProcessor $paypalInternal,
    ) {
    }

    public function pay(string $sum): bool
    {
        try {
            $this->paypalInternal->pay((int) floor($sum));
        } catch (\Exception $e) {
            throw new ErrorMessageException($e->getMessage());
        }

        return true;
    }
}
