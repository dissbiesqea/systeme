<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Enum\CouponTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $coupon = new Coupon();
        $coupon->setCode('P10');
        $coupon->setType(CouponTypeEnum::PERCENT->value);
        $coupon->setPercentDiscount('10');
        $manager->persist($coupon);

        $coupon2 = new Coupon();
        $coupon2->setCode('P100');
        $coupon2->setType(CouponTypeEnum::PERCENT->value);
        $coupon2->setPercentDiscount('100');
        $manager->persist($coupon2);

        $coupon3 = new Coupon();
        $coupon3->setCode('M1EUR');
        $coupon3->setType(CouponTypeEnum::FIXED->value);
        $coupon3->setFixedDiscount('5');
        $manager->persist($coupon2);

        $manager->flush();
    }
}
