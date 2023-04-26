<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Form\LoginFormType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Notification\CreationCompteNotification;


class RegistrationController extends AbstractController
{
    
   
    #[Route('/register', name: 'app_register',methods: ['GET','POST'])]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Créer une instance de l'entité User
        $user = new User();

        // Créer le formulaire à partir de la classe RegisterType
        $form = $this->createForm(RegisterType::class, $user);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe de l'utilisateur
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Enregistrer l'utilisateur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger l'utilisateur vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 /**
     */
    #[Route('/login', name: 'app_login')]

    public function login() {
        $form = $this->createForm(LoginFormType::class);
        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
