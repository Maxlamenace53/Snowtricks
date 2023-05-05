<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\PhotoTrickRepository;
use App\Repository\TrickRepository;
use App\Service\FileUploader;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/trick')]
class TrickController extends AbstractController
{
    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_USER', message: 'Connecter pour créer !Telle est la devise de SnowTricks')]
    #[Route('/new', name: 'app_trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrickRepository $trickRepository, FileUploader $fileUploader): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        $trick->setUser($this->getUser() );
        $trick->setCreationDate(new \DateTimeImmutable('now'));

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('photoTricks')->all() as $key => $photoForm) {
                /** @var UploadedFile $image */
                $image = $photoForm->get('photo')->getData();
                if ($image) {
                    $fileName = $fileUploader->upload($image);
                    $trick->getPhotoTricks()->get($key)->setPhoto($fileName);
                }
            }

            foreach ($form->get('videoTricks')->all() as $key => $videoForm) {
                $video = $videoForm->get('video')->getData();
                if ($video) {
                    $trick->getVideoTricks()->get($key)->setVideo($video);
                }
            }

            $trickRepository->save($trick, true);

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trick_show', methods: ['GET'])]
    public function show(Trick $trick): Response
    {

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, TrickRepository $trickRepository, FileUploader $fileUploader, PhotoTrickRepository $photoTrickRepository): Response
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        $photoTrick = $photoTrickRepository->findOneBy(['trick' => $trick->getId()]);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $image */
            $image = $form->get('photoTricks')->getData();
            if ($image) {
                $fileName = $fileUploader->upload($image);
                $photoTrick->setPhoto($fileName);
            } else if ($form->get('removeImage')->getData()) {
                unlink($this->getParameter('uploads_path') . '/' . $photoTrick->getPhoto());
                $photoTrick->setPhoto(null);
            }




            $trickRepository->save($trick, true);

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }








    #[Route('/{id}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, TrickRepository $trickRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $trickRepository->remove($trick, true);
        }

        return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
    }



}
