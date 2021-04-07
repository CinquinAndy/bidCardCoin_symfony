<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lot;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $lots = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy9_Week();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'lots'=>$lots,
            'now'=>(new DateTime('NOW'))->format('Y-m-d')
        ]);
    }

    /**
     * @Route("/week/{numberOfWeek?1}", name="accueil_week")
     */
    public function indexWeeks($numberOfWeek): Response
    {
        $lots = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy_Week($numberOfWeek);
        return $this->render('accueil/week.html.twig', [
            'controller_name' => 'AccueilController',
            'lots'=>$lots,
            'numberOfWeek'=>$numberOfWeek,
            'now'=>(new DateTime('NOW'))->format('Y-m-d')
        ]);
    }

    /**
     * @Route("/date/{dateInf?2021-01-01}/{dateSupp?2021-01-02}", name="accueil_date")
     */
    public function indexDate($dateInf,$dateSupp): Response
    {
        if($dateInf>$dateSupp){
            $date=$dateInf;
            $dateInf=$dateSupp;
            $dateSupp=$date;
        }
        $lots = $this->getDoctrine()
            ->getRepository(Lot::class)
            ->findBy_Date($dateInf,$dateSupp);
        return $this->render('accueil/date.html.twig', [
            'controller_name' => 'AccueilController',
            'lots'=>$lots,
            'dateInf'=>$dateInf,
            'dateSupp'=>$dateSupp,
            'now'=>(new DateTime('NOW'))->format('Y-m-d')
        ]);
    }
}
