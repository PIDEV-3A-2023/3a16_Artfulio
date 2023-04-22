<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Entity\Commentaire;

use App\Form\ArtworkType;

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
    public function show(Artwork $artwork): Response
    {
        return $this->render('artwork/show.html.twig', [
            'artwork' => $artwork,
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
    
    #[Route('/search',name:"search")]
    function search(ArtworkRepository $repo,request $request){
        $email=$request->get("mail");
        $student=$repo->findByname($email);
        return $this->render('artwork/admin.html.twig',['artworks' => $student]);
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
