<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class HomePage extends AbstractController
{
    public function test(): Response
    {
        return new Response("sas");
    }
}
