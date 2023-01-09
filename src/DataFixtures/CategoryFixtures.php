<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_PELUCHES = 'CATEGORY_PELUCHES';

    public function load(ObjectManager $manager): void
    {
        $jouets = new Category();
        $jouets->setTitle('Jouets');
        $jouets->setImagePath('ane-a-bascule.jpeg');
        $manager->persist($jouets);

        $category = new Category();
        $category->setTitle('Peluches');
        $category->setParent($jouets);
        $category->setImagePath('ane-en-peluche.jpg');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_PELUCHES, $category);

        $category = new Category();
        $category->setTitle('Balades');
        $category->setImagePath('balade-en-ane.jpeg');
        $manager->persist($category);

        $manager->flush();
    }
}
