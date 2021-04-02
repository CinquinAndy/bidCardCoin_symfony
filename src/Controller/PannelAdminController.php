<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PannelAdminController extends AbstractController
{
    /**
     * @Route("/pannel/admin", name="pannel_admin")
     */
    public function index(): Response
    {
        return $this->render('pannel_admin/index.html.twig', [
            'controller_name' => 'PannelAdminController',
        ]);
    }
}
