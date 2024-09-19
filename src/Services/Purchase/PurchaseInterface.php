<?php

namespace App\Services\Purchase;

interface PurchaseInterface
{
    public function pay(string $sum): bool;
}
