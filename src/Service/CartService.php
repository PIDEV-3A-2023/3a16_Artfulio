<?php
namespace App\Service;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

Class CartService {
    private RequestStack $requestStack;
    private EntityManagerInterface $em;
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em){
        $this->requestStack = $requestStack;
        $this->em= $em;
    }
    public function addToCart(int $id) : void{

        $card =$this->requestStack->getSession()->get('cart',[]);
        if(!empty($card[$id])){
            $card[$id]++;
        }else{
            $card[$id] =1; 
        }
        $this->requestStack->getSession()->set('cart',$card);
    }
    public function getTotal(){
        $cart = $this->getSession()->get('cart');
        $cartData= [];
        foreach($cart as $id_produit => $quantity ){
            $product = $this->em->getRepository(Store::class)->findOneby(['id_produit'=> $id_produit]);
            if(!$product){
                
            }
            $cartData[] = [
                'product'=> $product,
                'quantity'=> $quantity
            ];
        }
        
        return $cartData;
        }
    public function removeCartAll(){
        return $this->getSession()->remove('cart');
    }
    public function removeToCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        unset($cart[$id]);
        return $this->getSession()->set('cart', $cart);
    }



    private function getSession() {
        return $this->requestStack->getSession();
    }
    public function getCart()
{
    $cart = $this->requestStack->getSession()->get('cart', []);
    $cartItems = [];

    foreach ($cart as $id => $quantity) {
        $product = $this->em->getRepository(Store::class)->findOneBy(['id_produit' => $id]);
        if ($product) {
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }

    return $cartItems;
}
}