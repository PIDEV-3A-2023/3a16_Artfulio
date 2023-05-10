<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


use Symfony\Component\Serializer\SerializerInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/home', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
//admin vue//
#[Route('/admin', name: 'app_admin')]
public function admin(UserRepository $userRepository): Response
{
  
    return $this->render('user/admin.html.twig', [
        'users' => $userRepository->findAll(),  ]);
}


    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route("/addJSON/new", name: "addJSON")]
    public function addJSON(Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setCinUser($req->get('cinUser'));
        $user->setAdresseUser($req->get('adresseUser'));
        $user->setImgUser($req->get('imgUser'));
        $user->setEmail($req->get('email'));
        $user->setUsername($req->get('username'));
        $user->setRoles($req->get('roles'));
        $user->setPassword($req->get('password'));

        $em->persist($user);
        $em->flush();

        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($jsonContent));
    }

    #[Route('/ShowUser/{id}', name: 'ShowUser')]
    public function ShowUser(NormalizerInterface $Normalizer,Request $request)
    {


        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($request->get('id'));
        $jsonContent = $Normalizer->normalize($user,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }


    #[Route('/{id}/show', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route("/{id}/updateJSON", name: "updateJSON")]
    public function updateJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $user->setCinUser($req->get('cinUser'));
        $user->setAdresseUser($req->get('adresseUser'));
        $user->setImgUser($req->get('imgUser'));
        $user->setEmail($req->get('email'));
        $user->setUsername($req->get('username'));
        $user->setRoles($req->get('roles'));
        $user->setPassword($req->get('password'));
        $em->flush();

        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'post:read']);
        return new Response("User updated successfully " . json_encode($jsonContent));
    }

    #[Route("/deleteJSON/{id}", name: "deleteJSON")]
    public function deleteJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("User deleted successfully " . json_encode($jsonContent));
    }


    #[Route("/afficherJsons", name: "afficherjson")]

    public function Aff(NormalizerInterface $Normalizer)
    {

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $jsonContent = $Normalizer->normalize($user,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }



    #[Route('/{id}/delete', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
