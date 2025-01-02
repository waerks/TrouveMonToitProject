<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    #[Route('/annonce/d/{codeTMT}/{type}', name: 'annonce_detail')]
    public function AnnonceDetail(string $type, int $codeTMT): Response
    {
        return $this->render('annonce/detail.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
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
