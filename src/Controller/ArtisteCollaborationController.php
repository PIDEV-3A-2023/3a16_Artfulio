<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteCollaborationController extends AbstractController
{
    #[Route('/artiste/collaboration', name: 'app_artiste_collaboration')]
    public function index(): Response
    {
        return $this->render('artiste_collaboration/index.html.twig', [
            'controller_name' => 'ArtisteCollaborationController',
        ]);
    }
    #[Route('/artiste/collaboration/add', name: 'app_artiste_collaboration')]
    public function ajouter(): Response
    {
        return $this->render('artiste_collaboration/index.html.twig', [
            'controller_name' => 'ArtisteCollaborationController',
        ]);
    }
}
