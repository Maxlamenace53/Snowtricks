<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    #[Route('/admin/trick', name: 'app_admin_trick')]
    public function index(): Response
    {
        return $this->render('admin/trick/index.html.twig', [
            'controller_name' => 'TrickController',
        ]);
    }
}
