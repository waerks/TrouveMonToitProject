<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Message;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MessageFixture extends Fixture implements DependentFixtureInterface
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

        // Simuler des conversations
        foreach ($annonces as $annonce) {
            // Sélectionner deux utilisateurs différents
            $expediteur = $faker->randomElement($users);
            $destinataire = $faker->randomElement($users);

            // Assurer que l'expéditeur et le destinataire sont différents
            while ($expediteur === $destinataire) {
                $destinataire = $faker->randomElement($users);
            }

            // Créer une série de messages entre ces utilisateurs
            $conversationLength = rand(5, 15);

            $lastDate = $faker->dateTimeBetween('-30 days', 'now');

            for ($i=0; $i < $conversationLength; $i++) { 
                $message = new Message();

                $message->setContenu($faker->sentence(rand(5, 15)));
                $message->setDateEnvoi($lastDate);
                $message->setAnnonce($annonce);

                // Alterner entre l'expéditeur et le destinataire
                if ($i % 2 === 0) {
                    $message->setExpediteur($expediteur);
                    $message->setDestinataire($destinataire);
                } else {
                    $message->setExpediteur($destinataire);
                    $message->setDestinataire($expediteur);
                }

                $lastDate = (clone $lastDate)->modify('+1 hour');

                $manager->persist($message);
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
