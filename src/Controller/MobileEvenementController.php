<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MobileEvenementController extends AbstractController
{
    #[Route('/mobile/evenement', name: 'app_mobile_evenement')]
    public function index(EvenementRepository $repo): Response
    {
        $evenements = $repo->findAll();
        /* $eventJson = $normalier->serialize($evenements, 'json', ['groups' => 'post:read']);

        $response = new JsonResponse($eventJson, 200, [], true);*/
        $response = $this->json($evenements, 200, [], ['groups' => 'post:read']);
        // dd($response);
        return $response;
    }
    #[Route('/mobile/evenement/add', name: 'add_mobile_evenement', methods: ['GET', 'POST'])]
    public function add(Request $request)
    {

        $evenement = new Evenement();
        $evenement->setTitre($request->request->get('titre'));
        $evenement->setType($request->request->get('type'));
        $evenement->setAdresse($request->request->get('adresse'));
        $evenement->setDescription($request->request->get('description'));
        // $evenement->setDateDebut($request->get('nom'));
        //  $evenement->setDateFin(new \DateTime($request->get('nom'));
        $em = $this->getDoctrine()->getManager();
        dd($evenement);
        $em->persist($evenement);
        $em->flush();
        $response = new JsonResponse(['status' => 200], Response::HTTP_CREATED);
        return $response;
    }

    #[Route('/mobile/evenement/edit/{id}', name: 'edit_mobile_evenement')]
    public function editCategorie(Request $request, $id, EvenementRepository $repo): JsonResponse
    {
        $evenement = $repo->find($id);

        if (!$evenement) {
            return new JsonResponse(['status' => 'Faild']);;
        }

        $evenement->setId($request->request->get('id'));
        $evenement->setType($request->request->get('type'));
        $evenement->setDescription($request->request->get('description'));
        $evenement->setAdresse($request->request->get('adresse'));
        //   $evenement->setDateDebut($request->request->get('dateDebut'));
        //  $evenement->setDateFin($request->request->get('date_fin'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();

        $response = new JsonResponse(['status' => 'edited'], Response::HTTP_OK);
        return $response;
    }

    #[Route('/mobile/evenement/delete/{id}', name: 'delete_mobile_evenement')]
    public function deleteEvenement(Request $request,  $id, EvenementRepository $repo, ManagerRegistry $manager): JsonResponse
    {

        $evenement = $repo->find($id);

        if (!$evenement) {
            throw $this->createNotFoundException("c'est evenement n'existe pas");
        }
        echo $evenement->getTitre();
        $em = $manager->getManager();
        $em->remove($evenement);
        $em->flush();

        $response = new JsonResponse(['status' => 'supprimé'], Response::HTTP_OK);
        return $response;
    }
}
