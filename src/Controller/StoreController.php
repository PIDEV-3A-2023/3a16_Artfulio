<?php
namespace App\Controller;
use App\Entity\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class StoreController extends AbstractController
{
    /**
     * @Route("/store", name="store_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $nameFilter = $request->query->get('name'); // Retrieve name filter value from request query
        $priceFilter = $request->query->get('price'); // Retrieve price filter value from request query

        $storeItems = $this->getDoctrine()->getRepository(Store::class)->findAll();

        // Apply name filter if present
        if ($nameFilter) {
            $storeItems = array_filter($storeItems, function ($storeItem) use ($nameFilter) {
                return stripos($storeItem->getNomArtwork(), $nameFilter) !== false;
            });
        }

        // Apply price filter if present
        if ($priceFilter) {
            if ($priceFilter === 'high') {
                usort($storeItems, function ($a, $b) {
                    return $b->getPrixArtwork() <=> $a->getPrixArtwork();
                });
            } elseif ($priceFilter === 'low') {
                usort($storeItems, function ($a, $b) {
                    return $a->getPrixArtwork() <=> $b->getPrixArtwork();
                });
            }
        }

        foreach ($storeItems as $storeItem) {
            $artworkId = 1; // Replace with the actual artwork ID you want to set
            $storeItem->setIdPieceArt($artworkId);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->render('store/index.html.twig', [
            'storeItems' => $storeItems,
            'controller_name' => 'StoreController',
        ]);
    }
}

