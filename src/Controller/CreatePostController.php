<?php

namespace App\Controller;

use App\Entity\UserPost;
use App\Form\UserPostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CreatePostController extends AbstractController
{
    #[Route('/create/post', name: 'app_create_post')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $userpost = new UserPost();
        $form = $this->createForm(UserPostType::class, $userpost);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $username = $this->getUser()->getUsername();
            $date = date_create(date("Y-m-d H:i:s"));
            $userpost->setDate($date);
            $userpost->setAuthor($username);

            $entityManager->persist($userpost);
            $entityManager->flush();
        }

        


        return $this->render('create_post/index.html.twig', [
            'UserPost_form' => $form,
        ]);
    }
}
