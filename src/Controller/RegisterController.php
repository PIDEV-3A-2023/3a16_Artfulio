<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserRepository $utilisateurRepository): Response
    {
        // Créer une instance de l'entité Utilisateur
        $user = new User();

        // Créer le formulaire à partir de la classe RegisterType
        $form = $this->createForm(RegisterType::class, $user, [
            'csrf_protection' => false,
        ]);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);
       
        if ($form->isSubmitted()&& $form->isValid()) {
            
            // Le formulaire est valide, faire quelque chose avec les données
            $utilisateurRepository->save($user, true);

            // Rediriger l'utilisateur vers la page de connexion
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }else{
            return $this->render('register/register.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        
    }
}
