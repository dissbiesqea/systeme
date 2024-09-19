<?php

namespace App\Model;

readonly class PurchaseResponse
{
    public function __construct(
        private bool $paid,
    ) {
    }

    public function getPaid(): bool
    {
        return $this->paid;
    }
}
