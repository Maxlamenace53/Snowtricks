<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    #[Route('/comment/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(\Symfony\Component\HttpFoundation\Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $slugTrick = $comment->getTrick()->getSlug();

            $commentRepository->remove($comment, true);
              $this->addFlash('success', 'Ton commentaire a bien été supprimé');

            return $this->redirectToRoute('app_trick_show', ['slug' => $slugTrick]);
        }
    }
}

