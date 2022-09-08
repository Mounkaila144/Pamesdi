<?php

namespace App\Controller;

use App\Entity\Donateur;
use App\Form\DonateurType;
use App\Repository\DonateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/donateur')]
class DonateurController extends AbstractController
{
    #[Route('/', name: 'app_donateur_index', methods: ['GET'])]
    public function index(DonateurRepository $donateurRepository): Response
    {
        return $this->render('donateur/index.html.twig', [
            'donateurs' => $donateurRepository->findAll(),
        ]);
    }

    #[Route('/don', name: 'app_donateur_don', methods: ['GET'])]
    public function don(): Response
    {
        return $this->render('donateur/don.html.twig');
    }

    #[Route('/new', name: 'app_donateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DonateurRepository $donateurRepository): Response
    {
        $donateur = new Donateur();
        $form = $this->createForm(DonateurType::class, $donateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donateurRepository->add($donateur, true);

            return $this->redirectToRoute('app_donateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('donateur/new.html.twig', [
            'donateur' => $donateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donateur_show', methods: ['GET'])]
    public function show(Donateur $donateur): Response
    {
        return $this->render('donateur/show.html.twig', [
            'donateur' => $donateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_donateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Donateur $donateur, DonateurRepository $donateurRepository): Response
    {
        $form = $this->createForm(DonateurType::class, $donateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donateurRepository->add($donateur, true);

            return $this->redirectToRoute('app_donateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('donateur/edit.html.twig', [
            'donateur' => $donateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donateur_delete', methods: ['POST'])]
    public function delete(Request $request, Donateur $donateur, DonateurRepository $donateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donateur->getId(), $request->request->get('_token'))) {
            $donateurRepository->remove($donateur, true);
        }

        return $this->redirectToRoute('app_donateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
