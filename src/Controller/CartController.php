<?php

namespace App\Controller;
use App\Service\CartService;
use App\Entity\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private array $cart = [];
    #[Route('/mon-panier' ,name: 'cart_index')]
    public function index(CartService $cartService): Response
    {
       
        
        return $this->render('cart/index.html.twig',['cart'=> $cartService->getTotal()]) ;
    }



    #[Route('/store/add/{id}', name: 'cart_add')]
    public function addToRoute(CartService $cartService, Store $store): Response
    {
        $cartService->addToCart($store->getIdProduit());
       
       return $this->redirectToRoute('cart_index');
    }
    #[Route('/store/removeAll', name: 'cart_removeAll')]
    public function RemoveAll(CartService $cartService): Response
    {
        $cartService->removeCartAll();
       
       return $this->redirectToRoute('store_index');
    }
    #[Route('/mon-panier/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeToCart(CartService $cartService, int $id): Response
    {
        $cartService->removeToCart($id);

        return $this->redirectToRoute('cart_index');
    }
 
}
