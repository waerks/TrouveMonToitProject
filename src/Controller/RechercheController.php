<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche/avancee', name: 'recherche_avancee')]
    public function RechercheAvancee(): Response
    {
        return $this->render('recherche/avancee.html.twig', [
            'controller_name' => 'RechercheController',
        ]);
    }

    #[Route('/recherche/resultats/{nombreAnnonces}', name: 'recherche_resultats')]
    public function RechercheResultats(int $nombreAnnonces): Response
    {
        return $this->render('recherche/resultats.html.twig', [
            'controller_name' => 'RechercheController',
        ]);
    }
}
