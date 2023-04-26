<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use App\Repository\UserRepository;
use App\Repository\ArtworkRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/{id}', name: 'app_profile_index', methods: ['GET'])]
    public function index(ChartBuilderInterface $chartBuilder,ArtworkRepository $ar,ProfileRepository $profileRepository,UserRepository $us,$id): Response
    {    
        // Retrieve data
        $images = $ar->findBytypeimage();
        $videos = $ar->findBytypevideo();
        $music = $ar->findBytypemusic();
    
        // Calculate counts
        $imageCount = count($images);
        $videoCount = count($videos);
        $musicCount = count($music);
    
        // Build chart
        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart->setData([
            'labels' => ['Images', 'Videos', 'Music'],
            'datasets' => [
                [
                    'label' => 'Media Types',
                    'data' => [$imageCount, $videoCount, $musicCount],
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56'],
                ],
            ],
        ]);
        return $this->render('profile/index.html.twig', [
            'profiles' => $profileRepository->findAll(),
            'users' => $us->finduser($id),
            'images' => $ar->findBytypeimage(),
            'videos' => $ar->findBytypevideo(),
            'music' => $ar->findBytypemusic(),
            'chart' => $chart,
            'imageCount'=>$imageCount,
            'videoCount'=>$videoCount,
            'musicCount'=>$musicCount,
        ]);
    }

    #[Route('/new', name: 'app_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProfileRepository $profileRepository): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileRepository->save($profile, true);

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id_profil}', name: 'app_profile_show', methods: ['GET'])]
    public function show(Profile $profile): Response
    {
        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    #[Route('/{id_profil}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileRepository->save($profile, true);

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id_profil}', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(Request $request, Profile $profile, ProfileRepository $profileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId_profil(), $request->request->get('_token'))) {
            $profileRepository->remove($profile, true);
        }

        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
