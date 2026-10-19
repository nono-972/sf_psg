<?php

namespace App\Controller;

use App\Entity\Effectif;
use App\Form\EffectifType;
use App\Repository\EffectifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/effectif')]
final class EffectifController extends AbstractController
{
    #[Route(name: 'app_effectif_index', methods: ['GET'])]
    public function index(EffectifRepository $effectifRepository): Response
    {
        return $this->render('effectif/index.html.twig', [
            'effectifs' => $effectifRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_effectif_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $effectif = new Effectif();
        $form = $this->createForm(EffectifType::class, $effectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($effectif);
            $entityManager->flush();

            return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('effectif/new.html.twig', [
            'effectif' => $effectif,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_effectif_show', methods: ['GET'])]
    public function show(Effectif $effectif): Response
    {
        return $this->render('effectif/show.html.twig', [
            'effectif' => $effectif,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_effectif_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Effectif $effectif, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EffectifType::class, $effectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('effectif/edit.html.twig', [
            'effectif' => $effectif,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_effectif_delete', methods: ['POST'])]
    public function delete(Request $request, Effectif $effectif, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$effectif->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($effectif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_effectif_index', [], Response::HTTP_SEE_OTHER);
    }
}
