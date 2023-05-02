<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Form\Promotion1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/promotion')]
class UserPromotionController extends AbstractController
{
    #[Route('/', name: 'app_user_promotion_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $promotions = $entityManager
            ->getRepository(Promotion::class)
            ->findAll();

        return $this->render('user_promotion/index.html.twig', [
            'promotions' => $promotions,
        ]);
    }

 /*    #[Route('/new', name: 'app_user_promotion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $promotion = new Promotion();
        $form = $this->createForm(Promotion1Type::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_promotion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_promotion/new.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    } */

    #[Route('/{id}', name: 'app_user_promotion_show', methods: ['GET'])]
    public function show(Promotion $promotion): Response
    {
        return $this->render('user_promotion/show.html.twig', [
            'promotion' => $promotion,
        ]);
    }

  //  #[Route('/{id}/edit', name: 'app_user_promotion_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Promotion $promotion, EntityManagerInterface $entityManager): Response
    //{
     //   $form = $this->createForm(Promotion1Type::class, $promotion);
// $form->handleRequest($request);

    //    if ($form->isSubmitted() && $form->isValid()) {
     //       $entityManager->flush();

       //     return $this->redirectToRoute('app_user_promotion_index', [], Response::HTTP_SEE_OTHER);
      //  }

       // return $this->renderForm('user_promotion/edit.html.twig', [
       //     'promotion' => $promotion,
        //    'form' => $form,
        //]);
    //}

   // #[Route('/{id}', name: 'app_user_promotion_delete', methods: ['POST'])]
   // public function delete(Request $request, Promotion $promotion, EntityManagerInterface $entityManager): Response
   // {
   //     if ($this->isCsrfTokenValid('delete'.$promotion->getId(), $request->request->get('_token'))) {
       //     $entityManager->remove($promotion);
        //    $entityManager->flush();
   //     }

     //   return $this->redirectToRoute('app_user_promotion_index', [], Response::HTTP_SEE_OTHER);
  //  }
}
