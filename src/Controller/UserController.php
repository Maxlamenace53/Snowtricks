<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    /*#[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }*/
 /*   #[Route('/trick', name: 'app_user_trick_index', methods: ['GET'])]
    public function TrickController(TrickRepository $trickRepository ): Response
    {
        return $this->render('user/trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }*/




  /*  #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, FileUploader $fileUploader): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $this->addFlash('success', 'Félicitation'.$user->getNickname() .'Votre compte a bien été créé !');
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }*/

    #[Route('/{slug}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user ): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,

        ]);
    }


    #[Route('/{slug}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $avatar = $form->get('avatar')->getData();
            if($avatar){
                $fileName = $fileUploader->upload($avatar);
                $user->setAvatar($fileName);
            }else if ($form->get('removeAvatar')->getData()){
                unlink($this->getParameter('uploads_path').'/'.$user->getAvatar());
                $user->setAvatar(null);
            }



            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }



}
