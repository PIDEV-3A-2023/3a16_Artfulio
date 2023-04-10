<?php

namespace App\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminEvenementController extends AbstractController
{
    /*  #[Route('/admin/evenement', name: 'app_admin_evenement')]
    public function index(): Response
    {
        return $this->render('admin_evenement/index.html.twig', [
            'controller_name' => 'AdminEvenementController',
        ]);
    }
*/

    #[Route('/aaaa', name: 'adm_evenement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, FlashyNotifier $flashy): Response
    {
        $flashy->success('Event created!', 'http://your-awesome-link.com');
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('admin_evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/ne', name: 'adm_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger,  FlashyNotifier $flashy): Response
    {
        $flashy->success('Event created!', 'http://your-awesome-link.com');
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $photo = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('evenement_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $evenement->setImage($newFilename);
            }
            //------------------------------------------------------------------

            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('adm_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'adm_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'adm_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('adm_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adm_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adm_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
