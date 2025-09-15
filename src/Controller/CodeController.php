<?php
namespace App\Controller;

use App\Repository\CodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Code;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CodeController extends AbstractController
{
    #[Route('/code', name: 'code.index')]
    public function index(CodeRepository $repository): Response
    {
        $codes = $repository->findAll();

        return $this->render('code/index.html.twig', [
            'codes' => $codes,
        ]);
    }

    #[Route('/code/create', name: 'code.create')]
    public function create(EntityManagerInterface $em): Response
    {
        $code = (new Code())
            ->setTitle('My first code');
        $em->persist($code);
        $em->flush();
        return $this->redirectToRoute('code.index');
        // OR 
        // return new Response('Code created with id '.$code->getId());
    }
    

}