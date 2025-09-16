<?php
namespace App\Controller;

use App\Entity\Code;
use App\Form\CodeType;
use App\Repository\CodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $code = new Code();

        $form = $this->createForm(CodeType::class, $code);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($code);
            $em->flush();

            $this->addFlash('success', 'Code has been created');
            return $this->redirectToRoute('code.index');
        }

        return $this->render('code/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
