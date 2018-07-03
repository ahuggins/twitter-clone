<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Tweet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TweetFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        
        $faker = Factory::create();
        for ($i=0; $i < 300; $i++) {
            $tweet = new Tweet();
            $randUser = $users[rand(0, 29)];
            $tweet->setUser($randUser);
            $tweet->setUserId($randUser->getId());
            $tweet->setBody($faker->realText(rand(30, 250)));
            $tweet->setCreatedAt($faker->dateTime());
            $manager->persist($tweet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            \App\DataFixtures\UserFixture::class
        ];
    }
}
