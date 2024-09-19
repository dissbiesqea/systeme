<?php

namespace App\Model;

class TargetSumResponse
{
    public function __construct(
        private float $price,
        private string $product,
        private string $taxNumber,
        private string $couponCode,
    ) {
    }

    public function getTargetSum(): float
    {
        return $this->price;
    }

    public function getProduct(): int
    {
        return $this->product;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode;
    }
}
