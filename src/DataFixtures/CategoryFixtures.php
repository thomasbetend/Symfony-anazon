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

        $peluches = new Category();
        $peluches->setTitle('Peluches');
        $peluches->setParent($jouets);
        $peluches->setImagePath('ane-en-peluche.jpg');
        $manager->persist($peluches);
        $this->addReference(self::CATEGORY_PELUCHES, $peluches);

        $balades = new Category();
        $balades->setTitle('Balades');
        $balades->setImagePath('balade-en-ane.jpeg');
        $manager->persist($balades);

        $manager->flush();
    }
}
