<?php
namespace App\Controller;
use App\Entity\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/store", name="store_index", methods={"GET"})
     */
    public function index(): Response
    {
        // Retrieve all items from the Store table
        $storeItems = $this->getDoctrine()->getRepository(Store::class)->findAll();

        // Set artwork ID for each store item
        foreach ($storeItems as $storeItem) {
            $artworkId = 1; // Replace with the actual artwork ID you want to set
            $storeItem->setIdPieceArt($artworkId);
        }

        // Persist changes to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Render a view to display the store items
        return $this->render('store/index.html.twig', [
            'storeItems' => $storeItems,
            'controller_name' => 'StoreController', // Pass the controller_name variable to the view
        ]);
    }
}

