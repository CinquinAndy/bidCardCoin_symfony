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
        $lots = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy10last();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'lots'=>$lots,
        ]);
    }
}
