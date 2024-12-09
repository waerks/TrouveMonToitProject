<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private $passwordHasher;
    private $slugger;

    public function __construct(UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger)
    {
        $this->passwordHasher = $passwordHasher;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        // Créer une instance de Faker
        $faker = Factory::create('fr_FR');

        // Créer des Users
        for ($i=0; $i < 5; $i++) { 
            $user = new User();

            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user,'mdp123'));
            $user->setNom($faker->lastName());
            $user->setPrenom($faker->firstName());
            $user->setTelephone($faker->phoneNumber());
            $user->setPhoto($faker->imageUrl());
            $user->generateSlug($this->slugger);

            $manager->persist($user);
        }

        // Créer l'admin
        $userAdmin = new User();

        $userAdmin->setEmail('admin@mail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordHasher->hashPassword($userAdmin,'admin123'));
        $userAdmin->setNom($faker->lastName());
        $userAdmin->setPrenom($faker->firstName());
        $userAdmin->setTelephone($faker->phoneNumber());
        $userAdmin->setPhoto($faker->imageUrl());
        $userAdmin->generateSlug($this->slugger);

        $manager->persist($userAdmin);

        
        $manager->flush();
    }
}
