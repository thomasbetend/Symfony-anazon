<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_DONKEY_PELUCHE = 'PRODUCT_DONKEY_PELUCHE';

    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Super peluche de donkey');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_PELUCHES));
        $product->setPrice(12.23);
        $manager->persist($product);
        $this->addReference(self::PRODUCT_DONKEY_PELUCHE, $product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
