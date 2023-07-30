<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost = new MicroPost();
        $microPost
            ->setTitle('Welcome to symfony')
            ->setText('This is a symfony 6 course')
            ->setCreated(new \DateTimeImmutable());
        $manager->persist($microPost);

        $microPost = new MicroPost();
        $microPost
            ->setTitle('Welcome to symfony 2')
            ->setText('This is a symfony 6 course 2')
            ->setCreated(new \DateTimeImmutable());
        $manager->persist($microPost);

        $manager->flush();
    }
}
