<?php

namespace App\Controller;

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
    #[Route('/raina', name: 'app_raina')]
    public function index2(): Response
    {
        return $this->render('home/raina.html.twig', [
            'a' => 2,
        ]);
    }
}
