<?php

namespace App\Controller;

use App\Entity\UserPost;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserPostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_user_post')]
    public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $UserPost = $entityManager->getRepository(UserPost::class)->find($id);
        $Comments = $entityManager->getRepository(Comment::class)->findBy(['post' => $UserPost]);

        if (!$UserPost) {
            throw $this->createNotFoundException(
                'No post found for id '.$id
            );
        }

        return $this->render('user_post/index.html.twig', [
            'controller_name' => 'UserPostController',
            'UserPost' => $UserPost,
            'Comments' => $Comments,
        ]);
    }
}
