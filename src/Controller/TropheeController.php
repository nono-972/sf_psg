<?php

namespace App\Controller;

use App\Entity\Trophee;
use App\Form\TropheeType;
use App\Repository\TropheeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/trophee')]
final class TropheeController extends AbstractController
{
    #[Route(name: 'app_trophee_index', methods: ['GET'])]
    public function index(TropheeRepository $tropheeRepository): Response
    {
        return $this->render('trophee/index.html.twig', [
            'trophees' => $tropheeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trophee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trophee = new Trophee();
        $form = $this->createForm(TropheeType::class, $trophee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trophee);
            $entityManager->flush();

            return $this->redirectToRoute('app_trophee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trophee/new.html.twig', [
            'trophee' => $trophee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trophee_show', methods: ['GET'])]
    public function show(Trophee $trophee): Response
    {
        return $this->render('trophee/show.html.twig', [
            'trophee' => $trophee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_trophee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trophee $trophee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TropheeType::class, $trophee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_trophee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trophee/edit.html.twig', [
            'trophee' => $trophee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trophee_delete', methods: ['POST'])]
    public function delete(Request $request, Trophee $trophee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trophee->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($trophee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trophee_index', [], Response::HTTP_SEE_OTHER);
    }
}
