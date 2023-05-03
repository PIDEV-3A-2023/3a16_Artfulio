<?php

namespace App\Controller;

use SendGrid;
use SendGrid\Mail\Mail;
use App\Entity\Collaboration;
use App\Form\CollaborationType;
use App\Service\FonctionsUtils;
use Symfony\Component\Mime\Email;
use App\Entity\ArtisteCollaboration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
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
        /*
        $repository = $entityManager->getRepository(Collaboration::class);

        $query = $repository->createQueryBuilder('c')
            ->where('c.name LIKE :name')
            ->setParameter('name', '%'.$name.'%')          // a la place de $name mettre app.user.name
            ->getQuery();

        $collaborations = $query->getResult();                 //rechercher selon ses collaboration

        */

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
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collaboration = new Collaboration();
        $collaboration->setStatus("en attente");
        $collaboration->setNomUser("lelouche");         //mettre nom user principale connecté
        $collaboration->setEmailUser("lelouche@gmail.com"); //mettre nom user 2
        $artCollaborat = new ArtisteCollaboration();
        $form = $this->createForm(CollaborationType::class, $collaboration);
        $form->remove('status');
        $form->remove('nomUser');
        $form->remove('emailUser');
        $form->handleRequest($request);



        // Send email to the use

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->persist($collaboration);
            $entityManager->flush();

            $artCollaborat->setIdCollaborationFk($collaboration->getIdCollaboration());
            $artCollaborat->setIdArtisteFk($collaboration->getIdCollaboration());   //mettre id artiste connecté
            $entityManager->persist($artCollaborat);

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
    public function detail(Collaboration $collaboration, ManagerRegistry $manager): Response
    {

        $repo = $manager->getRepository(Collaboration::class);      //ca on va supprimer
        $collaborations = $repo->findAll();

        /*
        $repository = $entityManager->getRepository(Collaboration::class);

        $query = $repository->createQueryBuilder('c')
            ->where('c.name LIKE :name')
            ->setParameter('name', '%'.$name.'%')          // a la place de $name mettre app.user.name
            ->getQuery();

        $collaborations = $query->getResult();                 //rechercher selon ses collaboration

        */

        //****************** recup d'info pour le chart ******************************************* */
        $dataTypeColChart = FonctionsUtils::comptageColParType($collaborations);

        $typeCol = [];
        $nbreCollab = [];
        foreach ($dataTypeColChart as $cle => $valeur) {
            $typeCol[] = $cle;
            $nbreCollab[] = $valeur;
        }
        //****************** ************************* ******************************************* */
        return $this->render('collaboration/show.html.twig', [
            'collaboration' => $collaboration,
            "type" => json_encode($typeCol),
            'nombre' => json_encode($nbreCollab)
        ]);
    }

    #[Route('/{idCollaboration}/edit', name: 'app_collaboration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollaborationType::class, $collaboration);
        $form->remove('status');
        $form->remove('nomUser');
        $form->remove('emailUser');
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
    /* #[Route('/admin/collaboration', name: 'app_admin_collaboration')]
    public function index(): Response
    {
        return $this->render('admin_collaboration/index.html.twig', [
            'controller_name' => 'AdminCollaborationController',
        ]);
    } */

    // #[Route('/admin/collaboration', name: 'app_collaboration_index', methods: ['GET'])]
    #[Route('//admin/collaboration', name: 'adm_collaboration_index', methods: ['GET'])]
    public function index2(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
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
    public function ajouter2(Request $request, EntityManagerInterface $entityManager): Response
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
    public function detail2(Collaboration $collaboration): Response
    {
        return $this->render('admin_collaboration/show.html.twig', [
            'collaboration' => $collaboration,
        ]);
    }

    #[Route('/{idCollaboration?1}/edit', name: 'adm_collaboration_edit', methods: ['GET', 'POST'])]
    public function edit2(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
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
    public function delete2(Request $request, Collaboration $collaboration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collaboration->getIdCollaboration(), $request->request->get('_token'))) {
            $entityManager->remove($collaboration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adm_collaboration_index', [], Response::HTTP_SEE_OTHER);
    }

}
