<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\PhotoTrick;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\CommentRepository;
use App\Repository\PhotoTrickRepository;
use App\Repository\TrickRepository;
use App\Repository\VideoTrickRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Knp\Component\Pager\PaginatorInterface;
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


        $photoTrick = new PhotoTrick();
        $photoTrick->setTrick($trick)->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('photoTricks')->all() as $key => $photoForm) {
                /** @var UploadedFile $image */
                $image = $photoForm->get('photo')->getData();
                if ($image) {
                    $fileName = $fileUploader->upload($image);
                    $trick->getPhotoTricks()->get($key)->setPhoto($fileName);
                    $trick->getPhotoTricks()->get($key)->setUser($this->getUser());
                }
            }

            foreach ($form->get('videoTricks')->all() as $key => $videoForm) {
                $video = $videoForm->get('video')->getData();
                if ($video) {
                    $trick->getVideoTricks()->get($key)->setVideo($video);
                    $trick->getVideoTricks()->get($key)->setUser($this->getUser());
                }
            }
                $mainPhoto =$form->get('mainPhoto')->getData();
                if ($mainPhoto){
                    $fileName = $fileUploader->upload($mainPhoto);
                    $trick->setMainPhoto($fileName);
                }


            $trickRepository->save($trick, true);

            $this->addFlash('success','Ton trick'.$trick->getNameTrick().'a bien été créée !');

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_trick_show', methods: ['GET', 'POST'])]
    public function show( EntityManagerInterface $manager ,Request $request,Trick $trick, CommentRepository $commentRepository, PaginatorInterface $paginator, PhotoTrick $photoTrick): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $comment->setUser($this->getUser() );
        $comment->setTrick($trick);




        if ($form->isSubmitted() && $form->isValid()) {
            //dd($comment);
            $commentRepository->save($comment, true);
            unset($form);
            $form = $this->createForm(CommentType::class);
            $this->addFlash('success','Ton commentaire à bien été crée');

        }


        $dql   = "SELECT c FROM App\Entity\Comment c WHERE c.trick = ".$trick->getId()." ORDER BY c.createDate DESC";
        $query = $manager->createQuery($dql);


        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*Nombre de page*/
            10 /*Limite par page*/
        );


        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'pagination'=>$pagination
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, TrickRepository $trickRepository, FileUploader $fileUploader, PhotoTrickRepository $photoTrickRepository, VideoTrickRepository $videoTrickRepository): Response
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
            } else if ($form->get('removePhoto')->getData()) {
                unlink($this->getParameter('uploads_path') . '/' . $photoTrick->getPhoto());
                $photoTrick->setPhoto(null);
            }

            $mainPhoto = $form->get('mainPhoto')->getData();
            if ($mainPhoto){
                $fileName = $fileUploader->upload($mainPhoto);
                $trick->setMainPhoto($fileName);
            }else if ($form->get('removeMainPhoto')->getData()){
                unlink($this->getParameter('uploads_path').'/'.$trick->getMainPhoto());
                $trick->setMainPhoto(null);
            }




            $trickRepository->save($trick, true);

            return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }








    #[Route('/{slug}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, TrickRepository $trickRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            foreach ($trick->getPhotoTricks() as $photoTrick)

            unlink($this->getParameter(('uploads_path').'/'.$photoTrick->getPhoto()));

            $trickRepository->remove($trick, true);
        }

        return $this->redirectToRoute('app_trick_index', [], Response::HTTP_SEE_OTHER);
    }



}
