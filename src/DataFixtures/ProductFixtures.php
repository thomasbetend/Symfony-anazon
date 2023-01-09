<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_DONKEY_PELUCHE = 'PRODUCT_DONKEY_PELUCHE';
    public const PRODUCT_DONKEY_PELUCHE2 = 'PRODUCT_DONKEY_PELUCHE2';
    public const PRODUCT_DONKEY_PELUCHE3 = 'PRODUCT_DONKEY_PELUCHE3';
    
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Super peluche de donkey');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_PELUCHES));
        $product->setPrice(12.23);
        $manager->persist($product);
        $this->addReference(self::PRODUCT_DONKEY_PELUCHE, $product);

        $product2 = new Product();
        $product2->setName('Drôle de peluche');
        $product2->setCategory($this->getReference(CategoryFixtures::CATEGORY_PELUCHES));
        $product2->setPrice(14.50);
        $manager->persist($product2);
        $this->addReference(self::PRODUCT_DONKEY_PELUCHE2, $product2);

        $product3 = new Product();
        $product3->setName('La plus belle des peluches');
        $product3->setCategory($this->getReference(CategoryFixtures::CATEGORY_PELUCHES));
        $product3->setPrice(23);
        $manager->persist($product3);
        $this->addReference(self::PRODUCT_DONKEY_PELUCHE3, $product3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
