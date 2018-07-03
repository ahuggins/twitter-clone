<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i=0; $i < 30; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
