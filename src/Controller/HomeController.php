<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController
{
    #[Route("/", name: "home")]
    #[Route("/code/{slug}--{id}", name: "code.show", requirements: ["id" => "\d+", "slug" => "[a-z0-9\-]+"])]
    public function index(Request $request, $slug, $id): Response
    {
        if ($slug && $id) {
            return new Response("Slug: $slug | ID: $id");
        }

        $name = $request->query->get('name', 'Anonyme');
        return new Response("Bonjour $name");
    }
}
