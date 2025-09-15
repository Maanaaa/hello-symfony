<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Reponse;
use Symfony\Component\Routing\Attribute\Route;

class HomeController
{
    #[Route("/", name: "home")]
    function index(): Response
    {
        return new Response("Hello, Symfony!");
    }
}

?>