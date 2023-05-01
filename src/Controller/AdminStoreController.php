<?php

namespace App\Controller;

use App\Entity\Store;
use App\Form\Store1Type;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/{id_produit}/edit', name: 'app_admin_store_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Store $store, StoreRepository $storeRepository): Response
    {
        $form = $this->createForm(Store1Type::class, $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storeRepository->save($store, true);

            return $this->redirectToRoute('app_admin_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_store/edit.html.twig', [
            'store' => $store,
            'form' => $form,
        ]);
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
