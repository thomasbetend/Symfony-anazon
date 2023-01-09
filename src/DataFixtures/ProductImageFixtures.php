<?php

namespace App\DataFixtures;

use App\Entity\ProductImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productImage = new ProductImage();
        $productImage->setPath('ane-en-peluche.jpg');
        $productImage->setPosition(1);
        $productImage->setProduct($this->getReference(ProductFixtures::PRODUCT_DONKEY_PELUCHE));
        $manager->persist($productImage);

        $productImage2 = new ProductImage();
        $productImage2->setPath('ane-en-peluche2.jpg');
        $productImage2->setPosition(1);
        $productImage2->setProduct($this->getReference(ProductFixtures::PRODUCT_DONKEY_PELUCHE2));
        $manager->persist($productImage2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
