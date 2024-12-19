<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\TypeAnnonce;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    private $doctrine;
    private $slugger;

    public function __construct(ManagerRegistry $doctrine, SluggerInterface $slugger)
    {
        $this->doctrine = $doctrine;
        $this->slugger = $slugger;
    }
    #[Route('', name: 'accueil')]
    public function Accueil(): Response
    {
        $annonces = $this->doctrine->getRepository(Annonce::class)->findAll();
        $typeAnnonces = $this->doctrine->getRepository(TypeAnnonce::class)->findAll();

        $vars = [
            'annonces' => $annonces,
            'typeAnnonces' => $typeAnnonces
        ];

        return $this->render('accueil/index.html.twig', $vars);
    }
}
