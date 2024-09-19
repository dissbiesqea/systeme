<?php

namespace App\Model\ValidationRequests;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class PurchaseRequest
{
    #[NotBlank]
    #[Assert\Type('integer')]
    #[CustomAssert\EntityExists(
        entityClass: Product::class,
        field: 'id',
        message: 'The value incorrect.'
    )]
    public int $product = 0;

    #[NotBlank]
    #[Assert\Type('string')]
    #[CustomAssert\TaxRegExp(
        message: 'The value incorrect.'
    )]
    public string $taxNumber = '';

    #[NotBlank]
    #[Assert\Type('string')]
    #[CustomAssert\EntityExists(
        entityClass: Coupon::class,
        field: 'code',
        message: 'The value incorrect.'
    )]
    public string $couponCode = '';

    #[NotBlank]
    #[Assert\Type('string')]
    #[CustomAssert\PaymentProcessorEnumChoice]
    public string $paymentProcessor = '';

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

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }
}
