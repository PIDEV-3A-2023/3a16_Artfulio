<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Adminn')]
class AdminController extends AbstractController
{
    #[Route('/abc', name: 'app_admin_ad')]
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
