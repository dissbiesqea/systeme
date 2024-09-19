<?php

namespace App\Helper;

use App\Enum\CouponTypeEnum;
use App\Enum\TaxEnum;

class CalculationHelper
{
    public static function getCalculate(
        string $price,
        int $type,
        int $percentDiscount,
        string $fixedDiscount,
        string $targetSum,
    ): string {
        if ($type === CouponTypeEnum::PERCENT->value) {
            $price = $price - ($price * $percentDiscount / 100);
        }

        if ($type === CouponTypeEnum::FIXED->value) {
            $price = $price - $fixedDiscount;
        }

        $taxEnum = TaxEnum::getFromRegExpCheck($targetSum);

        if ($taxEnum) {
            $price = $price + (TaxEnum::getTax($taxEnum) / 100) * $price;
        }

        return (string) $price;
    }
}
