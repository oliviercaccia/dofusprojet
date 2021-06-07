<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $onePost = new Post();
            $onePost->setTitle($faker->word());
            $onePost->setDescription($faker->text(255));
            $onePost->setUrlImage($faker->imageUrl(250, 250, "cats"));
            $manager->persist($onePost);
        }

        for ($i = 0; $i < 10; $i++) {
            $author = new User();
            $author->setNickname($faker->username);
            $author->setPassword($faker->password);
            $author->setRoles(["USER_ROLE"]);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
