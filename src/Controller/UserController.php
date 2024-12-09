<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/espace-personnel', name: 'user_gestion')]
    public function UserGestion(): Response
    {
        return $this->render('user/gestion.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/profil/{userName}', name: 'user_profil')]
    public function UserProfil(string $userName): Response
    {
        return $this->render('user/profil.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/messagerie/{destinataireName}', name: 'user_messages')]
    public function UserMessages(string $destinataireName): Response
    {
        return $this->render('user/messages.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
