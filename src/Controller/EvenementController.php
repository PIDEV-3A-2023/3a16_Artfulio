<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EventLike;
use App\Entity\ParticipEvent;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EventLikeRepository;
use App\Repository\ParticipEventRepository;
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
use Symfony\Component\HttpFoundation\JsonResponse;

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
            ->find(42);

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
        echo $evenement->getLongitude();
        return $this->render('evenement/mapAdresse.html.twig', [
            'evenement' => $evenement,
            'lon' => json_encode($evenement->getLongitude()),
            'lat' => json_encode($evenement->getLatitude()),

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
    public function like(Evenement $evenement, ManagerRegistry $manager): Response
    {
        //$user = $this->getUser();   a décomenter fonction symfony qui permet de recupérer le user connecté
        $em = $manager->getManager();    //a effacer plus tard
        $repoEvent = $manager->getRepository(User::class);  //a effacer plus tard
        $user = $repoEvent->find(42);                    //a effacer plus tard

        //********************************************************************************* */

        $likeRrepo = $manager->getRepository(EventLike::class);
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


    #[Route('/{id}/participe', name: 'app_evenement_participe')]
    public function participer(Evenement $evenement, ManagerRegistry $manager): Response
    {
        //$user = $this->getUser();   a décomenter fonction symfony qui permet de recupérer le user connecté
        $em = $manager->getManager();    //a effacer plus tard
        $partRrepo = $manager->getRepository(User::class);  //a effacer plus tard
        $user = $partRrepo->find(42);                    //a effacer plus tard

        $partRrepo = $manager->getRepository(ParticipEvent::class);

        //1er cas le user n'est pas connecté
        if (!$user) {
            return $this->json([
                'code' => 403,
                'message' => "non autorise"
            ], 403);
        }
        //2e cas/ user connecté, on test si il a déja aimé lévenement
        // (ici il a déja mis un like)
        if ($evenement->isParticipeByUser($user)) {
            //on recherche le participant en fonction de l'evenement et du user
            $part = $partRrepo->findOneBy(
                [
                    'evenement' => $evenement,
                    'user' => $user
                ]
            );
            $em->remove($part); //efface le like
            $em->flush();

            //on retourne le js avec un code,un message et le nbre de partcipant de levenement
            return $this->json([
                'code' => 200,
                'message' => "participant enleve",
                'participes' => $partRrepo->count(['evenement' => $evenement]) //on recupere le nbre de partcipent de cette evenement
            ], 200);
        }
        //3e cas connecté et na pas encore mis de like
        //on créer un nouveu like et on laffecte a levenement et au user
        $participe = new ParticipEvent();
        $participe->setEvenement($evenement)
            ->setUser($user);
        $em->persist($participe);
        $em->flush();

        return $this->json([
            'code' => 200,
            'message' => "sa marche bien",
            'participes' => $partRrepo->count(['evenement' => $evenement])
        ], 200);
    }

    #[Route('/{id?10}/ajax', name: 'ajax_recup_event')]
    public function ajaxRecupEvent(ManagerRegistry $manager, Request $request, Evenement $evenement = null)
    {

        $data = [
            'id' => $evenement->getId(),
            'type' => $evenement->getType(),
            'description' => $evenement->getDescription(),
            'latitude' => $evenement->getLatitude(),
            'longitude' => $evenement->getLongitude(),
            'adresse' => $evenement->getAdresse()
        ];

        return new JsonResponse($data);
    }
}
