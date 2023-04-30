<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use SendGrid\Mail\Mail;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Dompdf\Options;
use Dompdf\Dompdf;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
{
    $search = $request->query->get('search');

    $queryBuilder = $entityManager->getRepository(Reclamation::class)->createQueryBuilder('r');
    
    if ($search) {
        $queryBuilder->where('r.email = :search')->setParameter('search', $search);
    }


    $pagination = $paginator->paginate(
        $queryBuilder,
        $request->query->getInt('page', 1),
        5 // Number of items per page
    );

    return $this->render('reclamation/index.html.twig', [
        'reclamations' => $pagination,
    ]);
} 

#[Route('/{idRec}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(ReclamationType::class, $reclamation);
    $form->handleRequest($request);
    $abc = $reclamation->getTitre();
    $bcd = $reclamation->getReclamationSec();

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        // Create and send email using SendGrid API
     $email = new Mail();
     $userEmail = $reclamation->getEmail();
     $email->setFrom("daadsoufi01@gmail.com", "Manager");
     $email->setSubject($reclamation->getTitre());
     $email->addTo($reclamation->getEmail(), "");
     $email->addContent("text/plain", "Updated reclamation: " . $reclamation->getReclamationSec());
     $sendgrid = new \SendGrid('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');
     $reclamation-> setTitre($abc);
     $reclamation-> setReclamationSec($bcd);
     $sendgrid->send($email);

     return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
     

    }

    return $this->renderForm('reclamation/edit.html.twig', [
        'reclamation' => $reclamation,
        'form' => $form,
        'editMode' => true,
    ]);
     
}

    #[Route('/admin', name: 'app_admin')]
    public function admin(Request $request, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $this->getDoctrine()->getRepository(Reclamation::class)->createQueryBuilder('r');
        $search = $request->query->get('search');
    
        if ($search) {
            $queryBuilder->where('r.email LIKE :search')
                         ->setParameter('search', '%'.$search.'%');
        }
    
        $sortBy = $request->query->get('sort_by');
        switch ($sortBy) {
            case 'idUser_asc':
                $queryBuilder->orderBy('r.idUser', 'ASC');
                break;
            case 'idUser_desc':
                $queryBuilder->orderBy('r.idUser', 'DESC');
                break;
            case 'titre_asc':
                $queryBuilder->orderBy('r.titre', 'ASC');
                break;
            case 'titre_desc':
                $queryBuilder->orderBy('r.titre', 'DESC');
                break;
                case 'reclamationSec_asc':
                $queryBuilder->orderBy('r.reclamationSec', 'ASC');
                break;
            case 'reclamationSec_desc':
                $queryBuilder->orderBy('r.reclamationSec', 'DESC');
                break;
            case 'email_asc':
                $queryBuilder->orderBy('r.email', 'ASC');
                break;
            case 'email_desc':
                $queryBuilder->orderBy('r.email', 'DESC');
                break;
            default:
                $queryBuilder->orderBy('r.idRec', 'ASC');
                break;

        }
    
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1), // Default page number
            3 // Items per page
        );
    
        return $this->render('reclamation/admin.html.twig', [
            'reclamations' => $pagination,
        ]);
    }
    






#[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $reclamation = new Reclamation();
    $reclamation->setidUser($this->getUser()->getId());
    $form = $this->createForm(ReclamationType::class, $reclamation);
    $form->handleRequest($request);
    

    if ($form->isSubmitted() && $form->isValid()) {



        $entityManager->persist($reclamation);
        $entityManager->flush();

        $pdfFile = $this->generatePdf($reclamation);


        $userEmail = $reclamation->getEmail();
        $userName = substr($userEmail, 0, strpos($userEmail, '@'));

        $userEmailMessage = new Mail();
        $userEmailMessage->setFrom("artfulio.manager@gmail.com", "Artfulio Bot");
        $userEmailMessage->addTo($userEmail, $userName);
        $userEmailMessage->setSubject("Reclamation créée");
        $userEmailMessage->addContent("text/plain", "Votre réclamation a été créée avec succès.");
        $attachment = new \SendGrid\Mail\Attachment();
        $attachment->setContent(base64_encode(file_get_contents($pdfFile)));
        $attachment->setType("application/pdf");
        $attachment->setFilename("reclamation_detail.pdf");
        $attachment->setDisposition("attachment");
        $userEmailMessage->addAttachment($attachment);

        $managerEmailMessage = new Mail();
        $managerEmailMessage->setFrom("artfulio.manager@gmail.com", "Artfulio Bot");
        $managerEmailMessage->addTo("daadsoufi01@gmail.com", "Manager");
        $managerEmailMessage->setSubject("Reclamation créée");
        $managerEmailMessage->addContent("text/plain", "Une réclamation a été créée par ".$userEmail);
        $managerEmailMessage->addAttachment($attachment);

        $sendgrid = new \SendGrid('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');

        try {
            // $response = $sendgrid->send($userEmailMessage);
            // $response = $sendgrid->send($managerEmailMessage);

            return $this->redirectToRoute('app_artwork_index', [], Response::HTTP_SEE_OTHER);
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    return $this->renderForm('reclamation/new.html.twig', [
        'reclamation' => $reclamation,
        'form' => $form,
        'editMode' => false,
    ]);
}

private function imageToBase64($path) {
    $path = $path;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

private function generatePdf(Reclamation $reclamation): string
{

    $imagePath = $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/assets/images/up1.jpg');

    $html = $this->renderView('reclamation/reclamation_pdf.html.twig', [
        'reclamation' => $reclamation,
        'image_url' => $imagePath
    ]);

    $pdfFile = tempnam(sys_get_temp_dir(), 'reclamation_detail_') . '.pdf';

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    file_put_contents($pdfFile, $dompdf->output());

    return $pdfFile;
}






    #[Route('/{idRec}', name: 'app_Reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    #[Route('/{idRec}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdRec(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
    
    
    
    
}
