<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Annonce;
use App\Entity\Chambre;
use App\Entity\Energie;
use App\Entity\Categorie;
use App\Entity\Chauffage;
use App\Entity\Proximite;
use App\Entity\Equipement;
use App\Entity\Statistique;
use App\Entity\TypeAnnonce;
use App\Entity\Localisation;
use App\Entity\Caracteristique;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnnonceFixture extends Fixture implements DependentFixtureInterface
{
    private $doctrine;
    private $slugger;

    public function __construct(ManagerRegistry $doctrine, SluggerInterface $slugger)
    {
        $this->doctrine = $doctrine;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Récupérer les utilisateurs
        $users = $this->doctrine->getRepository(User::class)->findAll();
        if (empty($users)) {
            throw new \Exception("Aucun utilisateur trouvé. Veuillez exécuter UserFixture d'abord.");
        }

        for ($i = 0; $i < 10; $i++) {
            $annonce = new Annonce();
            $annonce->setDescription($faker->text());
            $annonce->setDatePublication($faker->dateTime());
            $annonce->setEtat($faker->randomElement([
                'Neuf',
                'Rénovée',
                'À rénover',
                'Bon état',
                'À réhabiliter',
                'Ancienne',
                'Moyenne',
                'Dans son jus',
                'Endommagée',
                'À démolir'
            ]));
            $annonce->setStatut($faker->randomElement(['Publié', 'Archivé']));
            $annonce->setSlug($this->slugger->slug($faker->sentence(3)));
            $annonce->setNombreEtages($faker->randomDigitNotNull());
            $annonce->setNombreFacades($faker->randomDigitNotNull());
            $annonce->setParking($faker->randomDigit());

            // Associer un utilisateur au hasard
            $randomUser = $users[array_rand($users)];
            $annonce->setCreateur($randomUser);

            // Créer et associer une catégorie (Type Achat)
            $typeAchat = new Categorie();
            $typeAchat->setTypeAchat($faker->randomElement(['vendre', 'louer']));
            $manager->persist($typeAchat);
            $annonce->setCategorie($typeAchat);

            // Créer et associer un type de bien
            $typeBien = new TypeAnnonce();
            $typeBien->setTypeAnnonce($faker->randomElement([
                'Maison', 'Appartement', 'Studio', 'Villa', 'Duplex', 'Loft', 'Chalet', 'Ferme', 'Bungalow', 'Penthouse'
            ]));
            $manager->persist($typeBien);
            $annonce->setTypeAnnonce($typeBien);

            // Définir les prix et les charges selon le type d'achat
            if ($typeAchat->getTypeAchat() === 'vendre') {
                $annonce->setPrix($faker->randomFloat(2, 10000, 500000));
                $annonce->setCharges(null);
            } else {
                $annonce->setPrix($faker->randomFloat(2, 500, 5000));
                $annonce->setCharges($faker->randomFloat(2, 50, 500));
            }

            // Créer et associer une localisation
            $localisation = new Localisation();
            $localisation->setAdresseComplete($faker->streetAddress());
            $localisation->setVille($faker->city());
            $localisation->setCodePostal($faker->postcode());
            $localisation->setLatitude($faker->latitude());
            $localisation->setLongitude($faker->longitude());
            $localisation->setZone($faker->word());
            $manager->persist($localisation);
            $annonce->setLocalisation($localisation);

            // Créer et associer les énergies
            $energie = new Energie();
            $energie->setClasseEnergetique($faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']));
            $energie->setConsomationEnergetique($faker->randomNumber(5));
            $energie->setDoubleVitrage($faker->boolean());
            $energie->setPompesChaleur($faker->boolean());
            $energie->setPanneauxSolaires($faker->boolean());

            $chauffage = new Chauffage();
            $chauffage->setTypeChauffage($faker->randomElement([
                'Gaz', 'Electrique', 'Fioul', 'Bois', 'Pompe à chaleur',
                'Chauffage central', 'Chauffage au sol', 'Aérothermie', 'Chauffage solaire'
            ]));
            $manager->persist($chauffage);
            $energie->setChauffage($chauffage);
            $manager->persist($energie);
            $annonce->setEnergie($energie);

            // Créer et associer les caractéristiques
            $caracteristique = new Caracteristique();
            $caracteristique->setAnneeConstruction($faker->year());
            $caracteristique->setSurfaceHabitable($faker->randomNumber(3));
            $caracteristique->setNombreSallesDeBain($faker->randomDigitNotNull());
            $caracteristique->setNombreToilettes($faker->randomDigitNotNull());
            $caracteristique->setSurfaceCuisine($faker->randomNumber(2));
            $caracteristique->setSurfaceSalon($faker->randomNumber(2));
            $caracteristique->setSurfaceTerrain($faker->randomNumber(3));

            for ($j = 0; $j < 3; $j++) {
                $chambre = new Chambre();
                $chambre->setSurface($faker->randomNumber(2));
                $caracteristique->addChambre($chambre);
                $manager->persist($chambre);
            }

            $manager->persist($caracteristique);
            $annonce->setCaracteristiques($caracteristique);

            // Créer et associer les statistiques
            $statistique = new Statistique();
            $statistique->setNombreVisites($faker->randomNumber(5));
            $statistique->setDate($faker->dateTime());
            $manager->persist($statistique);
            $annonce->setStatistiques($statistique);

            // Persister l'annonce
            $manager->persist($annonce);

            // Définir les équipements
            $equipements = ['Piscine', 'Jardin', 'Garage', 'Terrasse', 'Ascenseur', 'Climatisation', 'Cheminée', 'Alarme', 'Domotique', 'Balcon'];

            foreach ($faker->randomElements($equipements, rand(2, 5)) as $equipementNom) {
                $equipement = new Equipement();
                $equipement->setNom($equipementNom);
                $equipement->setDisponible($faker->boolean());

                // Relier l'équipement à l'annonce
                $annonce->addEquipement($equipement);

                // Persist l'équipement
                $manager->persist($equipement);
            }

            // Définir les proximités
            $proximites = ['École', 'Supermarché', 'Hôpital', 'Parc', 'Station de métro', 'Centre commercial', 'Pharmacie', 'Cinéma', 'Gare', 'Plage'];

            foreach ($faker->randomElements($proximites, rand(3, 6)) as $proximiteNom) {
                $proximite = new Proximite();
                $proximite->setTypeProximite($proximiteNom);

                // Associer la proximité à la localisation
                $localisation->addProximite($proximite);

                // Persist la proximité
                $manager->persist($proximite);
            }

            // Définir les photos
            for ($e = 0; $e < rand(3, 8); $e++) { // Chaque annonce peut avoir entre 3 et 8 photos
                $photo = new Photo();
                $photo->setUrl($faker->imageUrl(640, 480, 'real estate', true, 'photo-' . $e)); // URL fictive avec Faker
                $photo->setUrl($faker->word());

                // Associer la photo à l'annonce
                $annonce->addPhoto($photo);

                // Persist la photo
                $manager->persist($photo);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class
        ];
    }
}