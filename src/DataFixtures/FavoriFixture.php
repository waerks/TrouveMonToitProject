<?php

namespace App\DataFixtures;

use App\Entity\Favori;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Annonce;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FavoriFixture extends Fixture implements DependentFixtureInterface
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Récupérer les utilisateurs
        $users = $this->doctrine->getRepository(User::class)->findAll();
        $annonces = $this->doctrine->getRepository(Annonce::class)->findAll();

        // Créer des favoris pour chaque utilisateur
        foreach ($users as $user) {
            // Choisir aléatoirement 3 annonces pour cet utilisateur
            $randomAnnonces = $faker->randomElements($annonces, 3);

            foreach ($randomAnnonces as $annonce) {
                $favori = new Favori();
                $favori->setUser($user);
                $favori->setAnnonce($annonce);
                $favori->setDateAjout($faker->dateTime());

                $manager->persist($favori);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            AnnonceFixture::class
        ];
    }
}
