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
            $user->setTelephone($faker->e164PhoneNumber());
            $user->generateSlug($this->slugger);

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
