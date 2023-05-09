<?php

namespace App\Controller;

use App\Entity\Store;
use App\Form\Store1Type;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
#[Route('/admin/store')]
class AdminStoreController extends AbstractController
{
    #[Route('/', name: 'app_admin_store_index', methods: ['GET'])]
    public function index(StoreRepository $storeRepository): Response
    {
        return $this->render('admin_store/index.html.twig', [
            'stores' => $storeRepository->findAll(),
        ]);
    }
    #[Route('/affjson', name: 'app_admin_store_affjson', methods: ['GET'])]
public function affjson(StoreRepository $storeRepository, SerializerInterface $serializer): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $categories = $entityManager->getRepository(Store::class)->findAll();

    $responseArray = array();
    foreach ($categories as $categorie) {
        $responseArray[] = array(
            
            'idProduit' => $categorie->getIdProduit(),
            'idPieceArt' => $categorie->getIdPieceArt(),
            
            
            'nomArtwork' => $categorie->getNomArtwork(),
            'prixArtwork' => $categorie->getPrixArtwork(),
            
            'imgArtwork' => $categorie->getImgArtwork(),
           

        );
    }

    $responseData = json_encode($responseArray);
    $response = new Response($responseData);
    $response->headers->set('Content-Type', 'application/json');

    return $response;

}
    #[Route('/new', name: 'app_admin_store_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StoreRepository $storeRepository): Response
    {
        $store = new Store();
        $form = $this->createForm(Store1Type::class, $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storeRepository->save($store, true);

            return $this->redirectToRoute('app_admin_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_store/new.html.twig', [
            'store' => $store,
            'form' => $form,
        ]);
    }

    #[Route('/{id_produit}', name: 'app_admin_store_show', methods: ['GET'])]
    public function show(Store $store): Response
    {
        return $this->render('admin_store/show.html.twig', [
            'store' => $store,
        ]);
    }

    #[Route('/{id_produit}/editjson', name: 'app_admin_store_editjson', methods: ['GET', 'POST'])]
public function editjson(Request $request, Store $store, StoreRepository $storeRepository): JsonResponse
{
    $form = $this->createForm(Store1Type::class, $store);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $storeRepository->save($store, true);

        return new JsonResponse([
            'success' => true,
            'message' => 'Store successfully updated',
        ]);
    }

    return new JsonResponse([
        'success' => false,
        'message' => 'Invalid form data',
        'errors' => (string) $form->getErrors(true),
    ], JsonResponse::HTTP_BAD_REQUEST);
}
#[Route('/{id}/editjson', name: 'store_edit_json', methods: ['PUT'])]
public function editStoreJson(Request $request, Store $store): Response
{
    $data = json_decode($request->getContent(), true);

    if (isset($data['nom_artwork'])) {
        $store->setNomArtwork($data['nom_artwork']);
    }

    if (isset($data['prix_artwork'])) {
        $store->setPrixArtwork($data['prix_artwork']);
    }

    if (isset($data['img_artwork'])) {
        $store->setImgArtwork($data['img_artwork']);
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($store);
    $entityManager->flush();

    return new JsonResponse(['message' => 'Store updated!']);
}
    #[Route('/{id_produit}/deljson', name: 'app_store_delete', methods: ['GET'])]
public function deleteStore(Request $request, Store $store, StoreRepository $storeRepository): JsonResponse
{
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($store);
    $entityManager->flush();

    return new JsonResponse(['success' => true]);
}

    


    
    #[Route('/{id_produit}', name: 'app_admin_store_delete', methods: ['POST'])]
    public function delete(Request $request, Store $store, StoreRepository $storeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$store->getIdProduit(), $request->request->get('_token'))) {
            $storeRepository->remove($store, true);
        }

        return $this->redirectToRoute('app_admin_store_index', [], Response::HTTP_SEE_OTHER);
    }
}

