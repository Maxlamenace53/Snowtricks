<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RobotTxtController extends AbstractController
{
    #[Route('/robot.txt', name: 'robot', defaults:  ['_format'=>'txt'])]
    public function index(): Response
    {

        $response = new Response(
            $this->renderView('/robot/robot.html.twig'),
            200
        );
        $response->headers->set('Content-Type', 'text/txt');

        return $response;

    }
}
