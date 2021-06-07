<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 40; $i++) {
            $onePost = new Post();
            $onePost->setTitle("Title $i");
            $onePost->setDescription("Lorem Ipsum Dolor $i");
            $manager->persist($onePost);
        }
        $manager->flush();

        $manager->flush();
    }
}
