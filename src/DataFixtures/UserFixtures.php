<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Admin');
        $user->plainPassword = 'demo';
        $manager->persist($user);

        $manager->flush();
    }
}
