<?php

namespace App\Controller;




use App\Repository\TrickRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class SitemapController extends AbstractController
{


    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format' => 'xml'])]
    public function index(): Response
    {
        $tricks = $this->trickRepository->findAll();

        $urls = [];
        foreach ($tricks as $trick){
            $urls[] = [
                'loc' =>$this->generateUrl(
                    'app_trick_show', ['slug'=>$trick->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'lastmod'=>$trick->getCreationDate()->format('Y-m-d')
            ];
        }

        $response = new Response(
            $this->renderView('/sitemap/sitemap.html.twig', ['urls' => $urls]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
