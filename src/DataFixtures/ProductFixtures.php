<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Iphone');
        $product->setPrice('100');
        $manager->persist($product);

        $product2 = new Product();
        $product2->setName('Наушники');
        $product2->setPrice('20');
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Чехол');
        $product3->setPrice('10');
        $manager->persist($product3);

        $manager->flush();
    }
}
