<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'a' => 2,
        ]);
    }
    #[Route('/list', name: 'app_evenement_list', methods: ['GET'])]
    public function Evenement(EvenementRepository $evenementRepository): Response
    {
        return $this->render('home/evenement.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
    #[Route('/don', name: 'app_donateur_don', methods: ['GET'])]
    public function don(): Response
    {
        return $this->render('donateur/don.html.twig');
    }
    #[Route('/raina', name: 'app_raina')]
    public function index2(): Response
    {
        return $this->render('home/raina.html.twig', [
            'a' => 2,
        ]);
    }
}
