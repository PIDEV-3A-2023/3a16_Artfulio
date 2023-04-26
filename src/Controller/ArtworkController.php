<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Entity\Commentaire;
use App\Form\ArtworkType;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\ArtworkRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\src\Controller\CommentaireController;
use App\Repository\CommentaireRepository;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/artwork')]
class ArtworkController extends AbstractController
{
    #[Route('/', name: 'app_artwork_index', methods: ['GET'])]
    public function index(Request $request,ArtworkRepository $artworkRepository,UserRepository $userRepository,CommentaireRepository $commentaireRepository,PaginatorInterface $paginator): Response
    {
       
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
        
        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(artwork::class);
                
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->findBytypeimage();//findall();
        
        // Paginate the results of the query
        $appointments = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );
        $users = array();
        foreach ($appointments as $appointment) {
            $user = $userRepository->findOneBy(array('id' => $appointment->getIdArtist()));
            array_push($users, $user);
        }
        // Render the twig view
        return $this->render('artwork/index.html.twig', [
            'paginator' => $appointments, 'commentaires' => $commentaireRepository->findAll(),'artworks' => $artworkRepository->findAll(),'users' => $users,
        ]);

    }
    #[Route('/like/{id_artwork}', name: 'like', methods: ['POST'])]

    public function likes(Request $request, Artwork $artwork)
    {
        $likesCount = $artwork->getLikesCount();
        $likesCount++;
        $artwork->setLikesCount($likesCount);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($artwork);
        $entityManager->flush();

        return $this->redirectToRoute('app_artwork_show', ['id' => $artwork->getidartwork()], Response::HTTP_SEE_OTHER);
    }
    #[Route('/artworks/{id}/like', name: 'artwork_like', methods: ['POST'])]

    public function like(Request $request, Artwork $artwork): JsonResponse
    {
        $likesCount = $artwork->getLikesCount();
        $likesCount++;
        $artwork->setLikesCount($likesCount);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($artwork);
        $entityManager->flush();

        return new JsonResponse(['likesCount' => $likesCount]);
    }

    
    #[Route('/music', name: 'app_artwork_music', methods: ['GET'])]
    public function music(Request $request,ArtworkRepository $artworkRepository,CommentaireRepository $commentaireRepository,PaginatorInterface $paginator): Response
    {
       
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
        
        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(artwork::class);
                
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->findBytypemusic();
        
        // Paginate the results of the query
        $appointments = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );
        
        // Render the twig view
        return $this->render('artwork/indexm.html.twig', [
            'paginator' => $appointments, 'commentaires' => $commentaireRepository->findAll(),'artworks' => $artworkRepository->findAll(),
        ]);

    }
    #[Route('/video', name: 'app_artwork_video', methods: ['GET'])]
    public function video(Request $request,ArtworkRepository $artworkRepository,CommentaireRepository $commentaireRepository,PaginatorInterface $paginator): Response
    {
       
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
        
        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(artwork::class);
                
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->findBytypevideo();
        
        // Paginate the results of the query
        $appointments = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );
        
        // Render the twig view
        return $this->render('artwork/indexv.html.twig', [
            'paginator' => $appointments, 'commentaires' => $commentaireRepository->findAll(),'artworks' => $artworkRepository->findAll(),
        ]);

    }
    #[Route('/admin', name: 'app_admin')]
    public function admin(ArtworkRepository $artworkRepository): Response
    {
      
        return $this->render('artwork/admin.html.twig', [
            'artworks' => $artworkRepository->findAll(),  ]);
    }
    #[Route('/new', name: 'app_artwork_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArtworkRepository $artworkRepository): Response
    {
        $artwork = new Artwork();
        $form = $this->createForm(ArtworkType::class, $artwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $text = $form['texte']->getData();
        
            // check if the text contains any bad word
            $badWords = ['bad', 'word', 'list'];
            foreach ($badWords as $badWord) {
                if (stripos($text, $badWord) !== false) {
                    // if a bad word is found, add an error to the form
                    $form->addError(new FormError('Your text contains a forbidden word.'));
                    // render the form with the error message
                    return $this->renderForm('artwork/new.html.twig', [
                        'artwork' => $artwork,
                        'form' => $form,
                    ]);
                }
            }

            $file = $form['img_artwork']->getData();
            $imageFile = $form->get('img_artwork')->getData();
            
            // génération d un nom de fichier unique
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            // déplacement du file dans le dossier public/images
            $imageFile->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            // mise à jour de l'attribut "image" de l'objet véhicule
            $artwork->setImgArtwork($newFilename);

            $artworkRepository->save($artwork, true);

            return $this->redirectToRoute('app_artwork_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artwork/new.html.twig', [
            'artwork' => $artwork,
            'form' => $form,
        ]);
    }

    #[Route('/{id_artwork}', name: 'app_artwork_show', methods: ['GET'])]
    public function show(CommentaireRepository $commentaireRepository,Artwork $artwork): Response
    {
        return $this->render('artwork/show.html.twig', [
            'commentaires' => $commentaireRepository->findAll(), 'artwork' => $artwork,
        ]);
        
    }

//     #[Route('/generateqrcode/{id_artwork}', name: 'app_artwork_generate_qr_code', methods: ['GET'])]
// public function generateQrCode(Request $request,$id_artwork): Response
// {
//     // Retrieve the entity manager of Doctrine
//     $em = $this->getDoctrine()->getManager();

//     // Get the artwork entity based on the ID passed in the request
//     $artwork = $em->getRepository(Artwork::class)->find($id_artwork);

//     // If no artwork found, return a 404 response
//     if (!$artwork) {
//         throw $this->createNotFoundException('Artwork not found');
//     }

//     // Create a QR code from the artwork lienartwork field
//     $qrCodeFactory = new QrCodeFactory();
//     $qrCode = $qrCodeFactory->create($artwork->getLienartwork());

//     // Generate the QR code image and save it in the public/qr directory
//     $qrCodeGenerator = $this->get('endroid.qrcode.generator');
//     $qrCodeGenerator->generate($qrCode, ['extension' => 'png', 'size' => 300], 'public/qr/'.$artwork->getIdartwork().'.png');

//     // Redirect back to the artwork details page
//     return $this->redirectToRoute('app_artwork_show', ['id' => $artwork->getId()]);
// }

    
#[Route('/pdf',name:"pdf")]
public function pdf(ArtworkRepository $artworkRepository)
{
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($pdfOptions);
    $html = $this->renderView('artwork/pdf.html.twig', [
        'artworks' =>$artworkRepository->findAll(),
    ]);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('B5', 'portrait');
    $dompdf->render();
    $pdfOutput = $dompdf->output();
    return new Response($pdfOutput, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="Artworks.pdf"'
    ]);
}
    #[Route('/order',name:"order")]
    function ordernsc(ArtworkRepository $repo){
    
        $student = $repo->orderbyname();
        return $this->render('artwork/admin.html.twig',['artworks' => $student]);
    
    }
    #[Route('/orderprice',name:"orderprice")]
    function orderprice(ArtworkRepository $repo){
    
        $student = $repo->orderbyprice();
        return $this->render('artwork/admin.html.twig',['artworks' => $student]);
    
    }
    #[Route('/orderdate',name:"orderdate")]
    function orderdate(ArtworkRepository $repo){
    
        $student = $repo->orderbydate();
        return $this->render('artwork/admin.html.twig',['artworks' => $student]);
    
    }
    #[Route('/searchf',name:"searchf")]
    function searchf(ArtworkRepository $repo,request $request){
        $email=$request->get("txtcom");
        $student=$repo->findByname($email);
        if (count($student) === 0) {
            return $this->render('artwork/not_found.html.twig');
        }
        return $this->render('artwork/search.html.twig',['msg'=>$email,'artworks' => $student]);
    }
    #[Route('/search',name:"search")]
    function search(ArtworkRepository $repo,request $request){
        $email=$request->get("mail");
        $student=$repo->findByname($email);
        return $this->render('artwork/admin.html.twig',['artworks' => $student]);
    }
    
    #[Route('/commentnow/{id_artwork}',name:"commentnow")]
    function comment(ArtworkRepository $artworkRepository, CommentaireRepository $repo,request $request,$id_artwork,UserRepository $userRepository){
        $text =$request->get("txtcom");
        $commentaire = new Commentaire();
        $commentaire->setIdArtwork($artworkRepository->find($id_artwork));
        $commentaire->setTexte($text);
        $commentaire->setIdUtil($userRepository->find(9));
        $commentaire->setDatePost(new \DateTime('now'));
        $repo->save($commentaire, true);
        return $this->redirectToRoute('app_artwork_show', ['id' => $id_artwork], Response::HTTP_SEE_OTHER);

        
    }

    #[Route('/{id_artwork}/edit', name: 'app_artwork_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artwork $artwork, ArtworkRepository $artworkRepository): Response
    {
        $form = $this->createForm(ArtworkType::class, $artwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form['img_artwork']->getData();
            $imageFile = $form->get('img_artwork')->getData();
            
            // génération d un nom de fichier unique
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            // déplacement du file dans le dossier public/images
            $imageFile->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            // mise à jour de l'attribut "image" de l'objet véhicule
            $artwork->setImgArtwork($newFilename);

            $artworkRepository->save($artwork, true);

            return $this->redirectToRoute('app_artwork_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artwork/edit.html.twig', [
            'artwork' => $artwork,
            'form' => $form,
        ]);
    }

    #[Route('/{id_artwork}', name: 'app_artwork_delete', methods: ['POST'])]
    public function delete(Request $request, Artwork $artwork, ArtworkRepository $artworkRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artwork->getIdArtwork(), $request->request->get('_token'))) {
            // $commentaireRepository->findAll()
            $artworkRepository->remove($artwork, true);
        }

        return $this->redirectToRoute('app_artwork_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
