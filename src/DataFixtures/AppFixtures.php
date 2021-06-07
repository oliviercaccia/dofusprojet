<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 40; $i++) {
            $onePost = new Post();
            $onePost->setTitle($faker->word());
            $onePost->setDescription($faker->text(255));
            $onePost->getUrlImage("");
            $manager->persist($onePost);
        }
        $manager->flush();
    }
}
