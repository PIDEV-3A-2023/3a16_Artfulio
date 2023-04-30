<?php

namespace App\Controller;

use App\Entity\Collaboration;
use App\Form\CollaborationType;
use App\Entity\ArtisteCollaboration;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin/collaboration')]
class AdminCollaborationController extends AbstractController
{
    /* #[Route('/admin/collaboration', name: 'app_admin_collaboration')]
    public function index(): Response
    {
        return $this->render('admin_collaboration/index.html.twig', [
            'controller_name' => 'AdminCollaborationController',
        ]);
    } */

    // #[Route('/admin/collaboration', name: 'app_collaboration_index', methods: ['GET'])]
    #[Route('/', name: 'adm_collaboration_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $collaborations = $entityManager
            ->getRepository(Collaboration::class)
            ->findAll();

        $collaborations = $paginator->paginate(
            $collaborations, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('admin_collaboration/index.html.twig', [
            'collaborations' => $collaborations,
        ]);
    }

    #[Route('/new', name: 'adm_collaboration_new', methods: ['GET', 'POST'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collaboration = new Collaboration();
        $collaboration->setStatus("en attente");
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

            return $this->redirectToRoute('adm_collaboration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaboration/new.html.twig', [
            'collaboration' => $collaboration,
            'form' => $form,
        ]);
    }

    #[Route('/{idCollaboration?1}/detail', name: 'adm_collaboration_show', methods: ['GET'])]
    public function detail(Collaboration $collaboration): Response
    {
        return $this->render('admin_collaboration/show.html.twig', [
            'collaboration' => $collaboration,
        ]);
    }

    #[Route('/{idCollaboration?1}/edit', name: 'adm_collaboration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollaborationType::class, $collaboration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('adm_collaboration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin_collaboration/edit.html.twig', [
            'collaboration' => $collaboration,
            'form' => $form,
        ]);
    }

    #[Route('/{idCollaboration}/delete', name: 'adm_collaboration_delete', methods: ['POST'])]
    public function delete(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collaboration->getIdCollaboration(), $request->request->get('_token'))) {
            $entityManager->remove($collaboration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adm_collaboration_index', [], Response::HTTP_SEE_OTHER);
    }
}
