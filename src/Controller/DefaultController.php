<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\GroupTrickRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(TrickRepository $trickRepository, GroupTrickRepository $groupTrickRepository): Response
    {
        $lastTrick = $trickRepository->findOneBy([], ['creationDate' => 'DESC']);
        $groups = $groupTrickRepository->findAll();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'LastTrick' => $lastTrick,
            'groups'=> $groups

        ]);
    }
}
