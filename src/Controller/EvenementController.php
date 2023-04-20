<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventLike;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EventLikeRepository;
use App\Service\UpluoaderService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        //    $flashy->success('Event created!', 'http://your-awesome-link.com');
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        $user = $entityManager          // pour les test de connexion mais a éffacer
            ->getRepository(User::class)
            ->find(2);

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            'user' => $user             // pour les test de connexion mais a éffacer
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UpluoaderService $upluoaderService): Response
    {

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $photo = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $directory = $this->getParameter('evenement_directory');

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $evenement->setImage($upluoaderService->upluadFile($photo, $directory));
            }
            //------------------------------------------------------------------

            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }


    #[Route('/{id?10}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement = null): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/adresse/{id}', name: 'app_evenement_adresse', methods: ['GET', 'POST'])]
    public function adresse(Evenement $evenement = null): Response
    {
        return $this->render('evenement/mapAdresse.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/like', name: 'app_evenement_like')]
    public function like(Evenement $evenement, ManagerRegistry $manager, EventLikeRepository $likeRrepo): Response
    {
        //$user = $this->getUser();   a décomenter fonction symfony qui permet de recupérer le user connecté
        $em = $manager->getManager();    //a effacer plus tard
        $repoEvent = $manager->getRepository(User::class);  //a effacer plus tard
        $user = $repoEvent->find(2);                    //a effacer plus tard

        //1er cas le user n'est pas connecté
        if (!$user) {
            return $this->json([
                'code' => 403,
                'message' => "non autorisé"
            ], 403);
        }
        //2e cas/ user connecté, on test si il a déja aimé lévenement
        // (ici il a déja mis un like)
        if ($evenement->isLikeByUser($user)) {
            //on recherche lévenement en fonction de l'evenement et du user
            $like = $likeRrepo->findOneBy([
                'evenement' => $evenement,
                'user' => $user
            ]);
            $em->remove($like); //efface le like
            $em->flush();

            //on retourne le js avec un code,un message et le nbre de like de levenement
            return $this->json([
                'code' => 200,
                'message' => 'like supprimé',
                'likes' => $likeRrepo->count(['evenement' => $evenement]) //on recupere le nbre de like de cette evenement
            ], 200);
        }
        //3e cas connecté et na pas encore mis de like
        //on créer un nouveu like et on laffecte a levenement et au user
        $like = new EventLike();
        $like->setEvenement($evenement)
            ->setUser($user);
        $em->persist($like);
        $em->flush();

        return $this->json([
            'code' => 200,
            'message' => "sa marche bien",
            'likes' => $likeRrepo->count(
                ['evenement' => $evenement]
            )
        ], 200);
    }
}


    /*
    
    #[Route('/', name: 'app_evenement_recherche', methods: ['GET', 'POST'])]
    public function recherche(Request $request, ManagerRegistry $em): Response
    {
        $form = $this->createFormBuilder()
            ->add('recherche')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recherche = $form->getData()['recherche'];

            $evenements = $this->getDoctrine()->getRepository(Evenement::class)->createQueryBuilder('e')
                ->where('e.titre LIKE :recherche OR e.description LIKE :recherche')
                ->setParameter('recherche', '%'.$recherche.'%')
                ->getQuery()
                ->getResult();

            return $this->render('evenement/resultats_recherche.html.twig', [
                'evenements' => $evenements,
            ]);
        }

        return $this->render('evenement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }   */


    //**************************************************************** */

    /* #[Route('/agenda', name: 'agenda', methods: ['POST'])]
    public function agenda(Request $request, ManagerRegistry $em): Response
    {
        $evenements = $em->getRepository(Evenement::class)->findAll();
        //   $user = $this->getUser();
        $user = new User();
        $user->setIdUser(1);

        if ($request->isMethod('POST')) {
            $evenementsIds = $request->request->get('evenementss');
            dd($evenementsIds);
            foreach ($evenementsIds as $evenementId) {
                $evenement = $em->getRepository(Evenement::class)->find($evenementId);
                $user->addEvenement($evenement);
            }
            $entityManager = $em->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('agenda/index.html.twig', [
            'evenements' => $evenements,
            'user' => $user,
        ]);
    } 
}*/