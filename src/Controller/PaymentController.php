<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Service\CartService;


class PaymentController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
public function checkout(CartService $cartService): Response
{
    Stripe::setApiKey('sk_test_51N0vhkJIrpXd4xn9nXX9LmMfY370R5PGGuMwTQj9V5mrN11bYgxdh9PufPpUOPwNkBJCQorCiA8oD0oNYV0ImiXA00kIxfSfBa');

    
    $lineItems = [];
    foreach ($cartService->getCart() as $item) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $item['product']->getNomArtwork(),
                ],
                'unit_amount' => $item['product']->getPrixArtwork() * 100, // Stripe expects the amount in cents
            ],
            'quantity' => 1,
        ];
    }

    

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $this->generateUrl('cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
    ]);

    return $this->redirect($session->url, 303);
}


    #[Route('/success', name: 'success')]
    public function success(): Response
    {
        return $this->render('payment/success.html.twig', []);
    }

    #[Route('/cancel', name: 'cancel')]
    public function cancel(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }
}
