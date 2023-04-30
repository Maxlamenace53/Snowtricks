<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\GroupTrickRepository;
use App\Repository\PhotoTrickRepository;
use App\Repository\TrickRepository;
use App\Repository\VideoTrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(TrickRepository $trickRepository, GroupTrickRepository $groupTrickRepository, PhotoTrickRepository $photoTrickRepository, VideoTrickRepository $videoTrickRepository): Response
    {
        $lastTrick = $trickRepository->findOneBy([], ['creationDate' => 'DESC']);
        $lastPhoto = $photoTrickRepository->findOneBy([], ['dateAdded' => 'DESC']);
        $lastVideo = $videoTrickRepository->findOneBy([], ['dateAdded' => 'DESC']);
        $groups = $groupTrickRepository->findAll();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'LastTrick' => $lastTrick,
            'LastPhoto' => $lastPhoto,
            'LastVideo'=> $lastVideo,
            'groups' => $groups

        ]);
    }
}
