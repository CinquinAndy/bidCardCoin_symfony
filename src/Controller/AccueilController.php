<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lot;
//use App\Repository\LotRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $lots1Weeks = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy9_Week();
        $lots2Weeks = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy9_2Week();
        $lots3Weeks = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy9_3Week();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'lots1Weeks'=>$lots1Weeks,
            'lots2Weeks'=>$lots2Weeks,
            'lots3Weeks'=>$lots3Weeks,
        ]);
    }
}
