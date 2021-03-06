<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    private function encode($user, $plaintextpassword)
    {
        return $this->passwordEncoder->encodePassword(
            $user,
            $plaintextpassword
        );
    }
    // public function load(ObjectManager $manager)
    // {
    //     $faker = Factory::create('fr_FR');
    //     for ($i = 0; $i < 4; $i++) {
    //         $onePost = new Post();
    //         $onePost->setTitle($faker->word());
    //         $onePost->setDescription($faker->text(255));
    //         $onePost->setUrlImage($faker->imageUrl(250, 250, "cats"));
    //         $manager->persist($onePost);
    //     }

    //     for ($i = 0; $i < 10; $i++) {
    //         $author = new User();
    //         $author->setNickname($faker->username);
    //         $author->setPassword($this->encode($author, "mdp"));
    //         $author->setRoles(["USER_ROLE"]);
    //         $manager->persist($author);
    //     }
    //     $manager->flush();
    // }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 4; $i++) {
            $simpleUser = new User();
            $simpleUser->setNickname(strtolower($faker->firstName()));
            $simpleUser->setPassword($this->encode($simpleUser, "mdp"));
            $simpleUser->setRoles(['ROLE_USER']);
            $manager->persist($simpleUser);
            for ($j = 0; $i < mt_rand(0, 4); $j++) {
                $onePost = new Post();
                $onePost->setTitle($faker->word());
                $onePost->setDescription($faker->text(255));
                $onePost->setUrlImage($faker->imageUrl(250, 250, "cats"));
                $onePost->setAuthor($simpleUser);
                $manager->persist($onePost);
            }
        }
        $manager->flush();
    }
}
