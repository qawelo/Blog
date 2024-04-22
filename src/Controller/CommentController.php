<?php

namespace App\Controller;

use App\Entity\UserPost;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    #[Route('/post/{id}/comment', name: 'app_comment')]
    public function index(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {
        $UserPost = $entityManager->getRepository(UserPost::class)->find($id);
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $username = $this->getUser()->getUsername();
            $date = date_create(date("Y-m-d H:i:s"));
            $comment->setDate($date);   
            $comment->setAuthor($username);
            $comment->setPost($UserPost);

            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('app_user_post', ['id' => $id]);
        }

        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
            'UserPost' => $UserPost,
            'Comment_form' => $form,
        ]);
    }
}
