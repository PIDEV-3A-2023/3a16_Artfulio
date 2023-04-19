<?php

namespace App\Controller;

use App\Entity\Collaboration;
use App\Form\CollaborationType;
use Symfony\Component\Mime\Email;
use App\Entity\ArtisteCollaboration;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/collaboration')]
class CollaborationController extends AbstractController
{
    #[Route('/', name: 'app_collaboration_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $collaborations = $entityManager
            ->getRepository(Collaboration::class)
            ->findAll();

        $collaborations = $paginator->paginate(
            $collaborations, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            7 /*limit per page*/
        );

        return $this->render('collaboration/index.html.twig', [
            'collaborations' => $collaborations,
        ]);
    }

    #[Route('/new', name: 'app_collaboration_new', methods: ['GET', 'POST'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
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

            $email = (new Email())
                ->from('georgeGreen@gmail.com')
                ->to('michelscoot@gmail.com')
                ->subject('Demande de collaboration!')
                ->text("Mme Astrid voulez vous collaborer avec moi!");

            $mailer->send($email);

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
