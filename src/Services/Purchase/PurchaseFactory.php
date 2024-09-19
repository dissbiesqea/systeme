<?php

namespace App\Services\Purchase;

use App\Enum\PaymentProcessorEnum;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PurchaseFactory
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createPurchase(string $purchase): PurchaseInterface
    {
        return match ($purchase) {
            PaymentProcessorEnum::PAYPAL->value => $this->container->get(Paypal::class),
            PaymentProcessorEnum::STRIP->value => $this->container->get(Stripe::class),
            default => throw new \InvalidArgumentException('Invalid purchase'),
        };
    }
}
