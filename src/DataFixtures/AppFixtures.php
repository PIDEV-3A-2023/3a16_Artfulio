<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\EventLike;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Collection;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $user = new User();

        $users = [];

        $user->setUsername("lelouche")
            ->setCinUser("123")
            ->setAdresseUser("aaa")
            ->setTypeRole("123")
            ->setIsPro(1)
            ->setEmailUser("123@gmail.com")
            ->setPasswordUser("aaa");
        $manager->persist($user);

        $users[] = $user;

        for ($i = 1; $i < 20; $i++) {
            $user = new User();
            $user->setUsername($faker->name)
                ->setCinUser($faker->sentence(6))
                ->setAdresseUser($faker->address)
                ->setTypeRole($faker->sentence(5))
                ->setIsPro(1)
                ->setEmailUser($faker->email)
                ->setPasswordUser($faker->sentence(5));

            $manager->persist($user);

            $users[] = $user;
        }

        for ($i = 1; $i < 20; $i++) {
            $evenement = new Evenement();
            $evenement->setTitre($faker->sentence(6))
                ->setType($faker->sentence(8))
                ->setDescription($faker->sentence(30))
                ->setAdresse($faker->address);

            $manager->persist($evenement);

            for ($j = 1; $j < mt_rand(0, 10); $j++) {
                $like = new EventLike();
                $like->setEvenement($evenement)
                    ->setUser($faker->randomElement($users));

                $manager->persist($like);
            }

            //symfony console doctrine:fixtures:load --no-interaction
        }

        $manager->flush();
    }
}
