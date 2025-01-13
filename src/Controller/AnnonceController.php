<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Chambre;
use App\Entity\Localisation;
use App\Entity\TypeAnnonce;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    private $doctrine;
    private $slugger;

    public function __construct(ManagerRegistry $doctrine, SluggerInterface $slugger)
    {
        $this->doctrine = $doctrine;
        $this->slugger = $slugger;
    }
    
    #[Route('/annonce/d/{codeTMT}/{type}', name: 'annonce_detail')]
    public function AnnonceDetail(string $type, int $codeTMT): Response
    {
        $annonce = $this->doctrine->getRepository(Annonce::class)->findOneBy(['code' => $codeTMT]);
        $typeAnnonce = $this->doctrine->getRepository(TypeAnnonce::class)->findOneBy(['type_annonce' => $type]);
        $localisation = $this->doctrine->getRepository(Localisation::class)->findAll();
        $chambres = $this->doctrine->getRepository(Chambre::class)->findAll();

        $vars = [
            'annonce' => $annonce,
            'typeAnnonce' => $typeAnnonce,
            'chambres' => $chambres,
            'localisation' => $localisation
        ];

        return $this->render('annonce/detail.html.twig', $vars);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/annonce/tableau-de-bord/{userName}', name: 'annonce_gestion')]
    public function AnnonceGestion(string $userName): Response
    {
        return $this->render('annonce/gestion.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/annonce/modifier-annonce', name: 'annonce_modification')]
    public function AnnonceModification(): Response
    {
        return $this->render('annonce/modification.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }

    #[Route('/annonce/publier-annonce', name: 'annonce_publication')]
    public function AnnoncePublication(): Response
    {
        return $this->render('annonce/publication.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }
}
