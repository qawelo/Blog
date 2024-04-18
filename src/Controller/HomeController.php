<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route(path: '/')]
    public function test(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        return new Response("sas");
    }
}
