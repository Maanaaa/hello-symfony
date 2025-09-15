<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController
{
    #[Route("/", name: "home")]
    function index(Request $request): Response
    {
        return new Response("Hello, " . $request->query->get('name', 'Symfony!'));
    }
}

?>