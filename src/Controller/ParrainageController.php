<?php

namespace App\Controller;

use App\Entity\Parrainage;
use App\Form\ParrainageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Repository\ParrainageRepository;
use Knp\Component\Pager\PaginatorInterface;
use SendGrid\Mail\Mail;
use App\Entity\User;


use Symfony\Component\Security\Core\Security;





#[Route('/parrainage')]
class ParrainageController extends AbstractController
{
    #[Route('/', name: 'app_parrainage_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $parrainages = $entityManager
            ->getRepository(Parrainage::class)
            ->findAll();

        return $this->render('parrainage/index.html.twig', [
            'parrainages' => $parrainages,
        ]);
    }

    #[Route('/admin', name: 'app_Parrainage_admin')]
    public function admin(Request $request, PaginatorInterface $paginator): Response
   {
    $queryBuilder = $this->getDoctrine()->getRepository(Parrainage::class)->createQueryBuilder('p');
    $search = $request->query->get('search');

    if ($search) {
        $queryBuilder->where('p.idUser = :search')
                     ->setParameter('search', $search);
    }

    $sortBy = $request->query->get('sort_by');
    switch ($sortBy) {
        case 'idUser_asc':
            $queryBuilder->orderBy('p.idUser', 'ASC');
            break;
        case 'idUser_desc':
            $queryBuilder->orderBy('p.idUser', 'DESC');
            break;
        
        default:
            $queryBuilder->orderBy('p.id_parrainage', 'ASC');
            break;
     }
    $pagination = $paginator->paginate(
        $queryBuilder,
        $request->query->getInt('page', 1), // Default page number
        3// Items per page
    );

    return $this->render('parrainage/admin.html.twig', [
        'parrainages' => $pagination,
    ]);
   
   
   }
    

    #[Route('/new', name: 'app_parrainage_new', methods: ['GET', 'POST'])]
    
    public function new(Security $security,Request $request, EntityManagerInterface $entityManager): Response
{

    $parrainage = new Parrainage();
    $form = $this->createForm(ParrainageType::class, $parrainage);

    $form->handleRequest($request);
//   $user=entityManager()->getRepository(User::class)->find();
    $parrainage->setIdUserz($security->getUser()->getId());

    if ($form->isSubmitted() && $form->isValid()) {

        $entityManager->persist($parrainage);
        $entityManager->flush();

        // $user = $parrainage->getidUser(); // Get the user who made the request
        // $userEmail = $user->getEmail(); // Get the user's email address
        // $userName = $user->getUsername(); // Get the user's name
        // $subject = "Demande créée avec succès"; // Set the subject for the user email
        // $message = "Bonjour $userName, votre demande de parrainage a été crée avec succès."; // Set the message for the user email

        // Send email to the user
        // $email = new Mail();
        // $email->setFrom("artfulio.manager@gmail.com", "Artfulio Bot");
        // $email->setSubject($subject);
        // $email->addTo($userEmail, $userName);
        // $email->addContent("text/plain", $message);
        // $sendgrid = new \SendGrid('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');
        // $sendgrid->send($email);
            
        
        

        
        // $adminSubject = "Une demande de parrainage a été créée"; // Set the subject for the admin email
        // $adminMessage = "Une demande de parrainage a été créée par $userName."; // Set the message for the admin email
        // // Send email to the Admin
        // $adminEmail = new Mail();
        // $adminEmail->setFrom("artfulio.manager@gmail.com", "Artfulio Bot");
        // $adminEmail->setSubject($adminSubject);
        // $adminEmail->addTo("daadsoufi01@gmail.com", "Admin");
        // $adminEmail->addContent("text/plain", $adminMessage);
        // $sendgrid = new \SendGrid('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');
        // $sendgrid->send($email);
        
        return $this->redirectToRoute('app_Parrainage_admin', [], Response::HTTP_SEE_OTHER);
    
    }

    return $this->renderForm('parrainage/new.html.twig', [
        'parrainage' => $parrainage,
        'form' => $form,
    ]);
}

    #[Route('/{idParrainage}', name: 'app_Parrainage_show', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager, Parrainage $parrainage): Response
    {    $parrainage = $entityManager->getRepository(Parrainage::class)->find($parrainage->getId());

    return $this->render('parrainage/show.html.twig', [
        'parrainage' => $parrainage,
    ]);
    }

 /*   #[Route('/{idParrainage}/edit', name: 'app_parrainage_edit', methods: ['GET', 'POST'])] 
    public function edit(Request $request, Parrainage $parrainage, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(ParrainageType::class, $parrainage);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        // Update the ispro attribute of the user
        $user = $parrainage->getUser();
        if ($parrainage->getIspro() == 1 && !$user->getIspro()) {
            $user->setIspro(true);
            $entityManager->flush();
        }

        // Send an email using SendGrid
        $email = new Mail();
        $email->setFrom("from@example.com", "Example Sender");
        $email->addTo($user->getEmail(), $user->getUsername());
        $email->setSubject("Your account has been upgraded");
        $email->addContent("text/plain", "Congratulations! Your account has been upgraded to Pro.");

        $sendgridApiKey = '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';
        $sendgrid = new \SendGrid($sendgridApiKey);
        $sendgrid->send($email);

        return $this->redirectToRoute('app_parrainage_admin', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('parrainage/edit.html.twig', [
        'parrainage' => $parrainage,
        'form' => $form,
    ]);
}*/


    #[Route('/{idParrainage}', name: 'app_parrainage_delete', methods: ['POST'])]
   
    public function delete(Request $request, Parrainage $parrainage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parrainage->getIdParrainage(), $request->request->get('_token'))) {
            $entityManager->remove($parrainage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_Parrainage_admin', [], Response::HTTP_SEE_OTHER);
    }
}
