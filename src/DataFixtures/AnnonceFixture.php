<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnnonceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Créer une instance de Faker
        $faker = Factory::create('fr_FR');

        // Création d'une Annonce
            
        //

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
