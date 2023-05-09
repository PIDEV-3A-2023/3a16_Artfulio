<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorie;
use App\Entity\Promotion;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Entity\Artwork;

#[Route('/api')]
class ApiController extends AbstractController
{

    #[Route('/categorie', name: 'categories_api', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {        
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        $responseArray = array();
        foreach ($categories as $categorie) {
            $responseArray[] = array(
                'id' => $categorie->getIdCategorie(),
                'type' => $categorie->getTypeCategorie(),
                'nom' => $categorie->getNomCategorie()
            );
        }

        $responseData = json_encode($responseArray);
        $response = new Response($responseData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    
    #[Route('/categorie/{id}', name: 'categorie_delete_api', methods: ['DELETE'])]
    public function deleteCategorie($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException('The categorie does not exist');
        }

        $entityManager->remove($categorie);
        $entityManager->flush();

        $response = new JsonResponse(['status' => 'deleted'], Response::HTTP_OK);
        return $response;
    }

    
    #[Route('/categorie/{id}', name: 'categorie_edit_api', methods: ['PUT'])]
    public function editCategorie(Request $request, $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            return new JsonResponse(['status' => 'Faild']);;
        }

        $categorie->setIdCategorie($request->request->get('id'));
        $categorie->setTypeCategorie($request->request->get('type'));
        $categorie->setNomCategorie($request->request->get('nom'));


        $entityManager->persist($categorie);
        $entityManager->flush();

        $response = new JsonResponse(['status' => 'edited'], Response::HTTP_OK);
        return $response;
    }

    
    #[Route('/categorie/add', name: 'categorie_add', methods: ['GET', 'POST'])]
    public function addCategorie(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $categorie->setIdCategorie($request->request->get('id'));
        $categorie->setTypeCategorie($request->request->get('type'));
        $categorie->setNomCategorie($request->request->get('nom'));
        $entityManager->persist($categorie);
        $entityManager->flush();

        $response = new JsonResponse(['status' => 'added'], Response::HTTP_CREATED);
        return $response;
    }

    /*===================================================================================*/

    #[Route('/promotion', name: 'promotion', methods: ['GET'])]
    public function indexPromo(EntityManagerInterface $entityManager): Response
    {        
        $entityManager = $this->getDoctrine()->getManager();
        $Promotions = $entityManager->getRepository(Promotion::class)->findAll();

        $responseArray = array();
        foreach ($Promotions as $Promotion) {
            $responseArray[] = array(
                'id' => $Promotion->getId(),
                'remise' => $Promotion->getRemise(),
                'type' => $Promotion->getType(),
                'nom_artwork' => $Promotion->getnomArtwork(),
                'prix_artwork' => $Promotion->getPrix()
            );
        }

        $responseData = json_encode($responseArray);
        $response = new Response($responseData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/promotion/{id}', name: 'promotion_delete_api', methods: ['DELETE'])]
    public function deletePromo($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $promotion = $entityManager->getRepository(Promotion::class)->find($id);

        if (!$promotion) {
            throw $this->createNotFoundException('The promotion does not exist');
        }

        $entityManager->remove($promotion);
        $entityManager->flush();

                
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'magicbook.pi@gmail.com';
        $mail->Password = 'wrqfzvitjcovvfqd';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $Subject = "Promotion Deleted";
        $body = "Promotion " .$id .+ " has been deleted.";
       
        $mail->setFrom('magicbook.pi@gmail.com', 'Departement Finance');
        $mail->addAddress('hamzahhajbelgacem@gmail.com', 'You');
        $mail->Subject = $Subject;
        $mail->Body = $body ;
        if ($mail->send()) {
        echo 'cbon ';
        } else {
        echo "echec";
        }

        $response = new JsonResponse(['status' => 'deleted'], Response::HTTP_OK);
        return $response;
    }

    
    #[Route('/promotion/{id}', name: 'promotion_edit_api', methods: ['PUT'])]
    public function editPromo(Request $request, $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $promotion = $entityManager->getRepository(Promotion::class)->find($id);

        if (!$promotion) {
            return new JsonResponse(['status' => 'Failed']);;
        }

        $promotion->setRemise($request->request->getInt('remise'));
        $promotion->setType($request->request->get('type'));

        $idArtwork = $request->request->getInt('id_artwork');
        $art = $entityManager->getRepository(Artwork::class)->find($idArtwork);
        $promotion->setArtwork($art);
        
        $promotion->setNomArtwork($request->request->get('nom_artwork'));
        $promotion->setPrix($request->request->get('prix_artwork'));


        $entityManager->persist($promotion);
        $entityManager->flush();

        $response = new JsonResponse(['status' => 'edited'], Response::HTTP_OK);
        return $response;
    }

    
    #[Route('/promotion/add', name: 'promotion_add_api', methods: ['GET', 'POST'])]
    public function addPromo(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $promotion = new Promotion();
        
        $promotion->setRemise($request->request->getInt('remise'));
        $promotion->setType($request->request->get('type'));
        $idArtwork = $request->request->getInt('id_artwork');
        $art = $entityManager->getRepository(Artwork::class)->find($idArtwork);
        
        if (!$art) {
            throw $this->createNotFoundException('The art does not exist');
        }
        $promotion->setArtwork($art);
        
        $promotion->setNomArtwork($request->request->get('nom_artwork'));
        $promotion->setPrix($request->request->get('prix_artwork'));

        $entityManager->persist($promotion);
        $entityManager->flush();

        

        $response = new JsonResponse(['status' => 'added'], Response::HTTP_CREATED);
        return $response;
    }

}
