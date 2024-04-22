<?php

namespace App\Controller;

use App\Entity\UserPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route(path: '/')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $repository = $entityManager->getRepository(UserPost::class);
        $UserPosts = $repository->findAll();


        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'UserPosts' => $UserPosts,
        ]);
    }
}
