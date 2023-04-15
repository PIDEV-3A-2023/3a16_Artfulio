<?php

namespace App\Controller;

use App\Entity\ArtisteCollaboration;
use App\Entity\Collaboration;
use App\Form\CollaborationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/collaboration')]
class CollaborationController extends AbstractController
{
    #[Route('/', name: 'app_collaboration_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collaborations = $entityManager
            ->getRepository(Collaboration::class)
            ->findAll();

        return $this->render('collaboration/index.html.twig', [
            'collaborations' => $collaborations,
        ]);
    }

    #[Route('/new', name: 'app_collaboration_new', methods: ['GET', 'POST'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collaboration = new Collaboration();
        $collaboration->setStatus("en attente");
        $collaboration->setNomUser("lelouche");
        $collaboration->setEmailUser("lelouche@gmail.com");
        $artCollaborat = new ArtisteCollaboration();
        $form = $this->createForm(CollaborationType::class, $collaboration);
        $form->remove('status');
        $form->remove('nomUser');
        $form->remove('emailUser');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($collaboration);
            $entityManager->flush();

            $artCollaborat->setIdCollaborationFk($collaboration->getIdCollaboration());
            $entityManager->persist($artCollaborat);
            $artCollaborat->setIdArtisteFk($collaboration->getIdCollaboration());

            $date = new \DateTime();
            $artCollaborat->setDateEntree($date);
            $entityManager->flush();

            return $this->redirectToRoute('app_collaboration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaboration/new.html.twig', [
            'collaboration' => $collaboration,
            'form' => $form,
        ]);
    }

    #[Route('/{idCollaboration}', name: 'app_collaboration_show', methods: ['GET'])]
    public function detail(Collaboration $collaboration): Response
    {
        return $this->render('collaboration/show.html.twig', [
            'collaboration' => $collaboration,
        ]);
    }

    #[Route('/{idCollaboration}/edit', name: 'app_collaboration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollaborationType::class, $collaboration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_collaboration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaboration/edit.html.twig', [
            'collaboration' => $collaboration,
            'form' => $form,
        ]);
    }

    #[Route('/{idCollaboration}', name: 'app_collaboration_delete', methods: ['POST'])]
    public function delete(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collaboration->getIdCollaboration(), $request->request->get('_token'))) {
            $entityManager->remove($collaboration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collaboration_index', [], Response::HTTP_SEE_OTHER);
    }
}
