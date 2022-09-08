<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\DonateurRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EvenementRepository $evenementRepository,AnnonceRepository $annonceRepository,DonateurRepository $donateurRepository): Response
    {
        $even = $evenementRepository->findAll();
        $counteven = $this->Count($even);
        $donateur = $donateurRepository->findAll();
        $countdonateur = $this->Count($donateur);
        $even = $evenementRepository->findAll();
        $counteven = $this->Count($even);
        $annonce = $annonceRepository->findAll();
        $countannonce = $this->Count($annonce);
        $sommeTotaleDon=$donateurRepository->findSommeTotal();

        return $this->render('admin/index.html.twig', [
            'counteven' => count($counteven),
            'countdonateur' => count($countdonateur),
            'countannonce' => count($countannonce),
            'sommeTotale'=>$sommeTotaleDon
        ]);
    }
    /**
     * @param array $pub
     * @return array
     */
    protected function Count(array $pub): array
    {
        $countPub = [];
        foreach ($pub as $as) {
            $countPub[] = $as->getId();
        }
        return $countPub;
    }
}
