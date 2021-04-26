<?php

namespace App\Controller;

use App\Entity\Enchere;
use App\Entity\Lot;
use App\Form\EnchereType;
use App\Repository\EnchereRepository;
use App\Repository\LotRepository;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enchere")
 */
class EnchereController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="enchere_index", methods={"GET"})
     */
    public function index(EnchereRepository $enchereRepository, int $numeroPage): Response
    {
        if ($numeroPage < 1) {
            $numeroPage = 0;
        }
        $endpage = (int)((($enchereRepository->findOneBy(array(), ['id' => 'DESC'])->getId()) / 100));
        return $this->render('enchere/index.html.twig', [
            'encheres' => $enchereRepository->findBy(array(), array(), 100, $numeroPage * 100),
            'page' => $numeroPage,
            'endpage' => $endpage,
            'tabAttributes' => ['Id',
                'PrixProposer',
                'EstAdjuger',
                'DateHeureVente',
                'Actions'
            ],
            'route' => $this->generateUrl('enchere_index', [
                'numeroPage' => 0
            ]),
            'route_m2' => $this->generateUrl('enchere_index', [
                'numeroPage' => $numeroPage - 2
            ]),
            'route_m1' => $this->generateUrl('enchere_index', [
                'numeroPage' => $numeroPage - 1
            ]),
            'route_p0' => $this->generateUrl('enchere_index', [
                'numeroPage' => $numeroPage
            ]),
            'route_p1' => $this->generateUrl('enchere_index', [
                'numeroPage' => $numeroPage + 1
            ]),
            'route_p2' => $this->generateUrl('enchere_index', [
                'numeroPage' => $numeroPage + 2
            ]),
            'route_end' => $this->generateUrl('enchere_index', [
                'numeroPage' => $endpage
            ])
        ]);
    }

    /**
     * @Route("/new/{lotId}&{venteId}", name="enchere_new", methods={"GET","POST"})
     */
    public function new(Request $request, LotRepository $lotRepository, VenteRepository $venteRepository,int $lotId, int $venteId): Response
    {
        $now=(new \DateTime('now'))->setTimezone(new \DateTimeZone("Europe/Paris"));
//        $arrayDateTime = array(
//            'year' => $now->format('Y'),
//            'month' => (int)$now->format('m'),
//            'day'=>$now->format('d'),
//            'hour'=>$now->format('h'),
//            'minute'=>$now->format('i'),
//            'second'=>$now->format('s')
//        );

        $enchere = new Enchere();
        $lot=$lotRepository->find($lotId);
        $vente=$venteRepository->find($venteId);
        $form = $this->createForm(EnchereType::class, $enchere);
        $form->get('lot')->setData($lot);
        $form->get('vente')->setData($vente);
        $form->get('dateHeureVente')->setData($now);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enchere);
            $entityManager->flush();

            return $this->redirectToRoute('enchere_index');
        }

        return $this->render('enchere/new.html.twig', [
            'enchere' => $enchere,
            'form' => $form->createView(),
            'lotId'=>$lotId,
            'venteId'=>$venteId
        ]);
    }

    /**
     * @Route("/{id}", name="enchere_show", methods={"GET"})
     */
    public function show(Enchere $enchere): Response
    {
        return $this->render('enchere/show.html.twig', [
            'enchere' => $enchere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enchere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enchere $enchere): Response
    {
        $form = $this->createForm(EnchereType::class, $enchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enchere_index');
        }

        return $this->render('enchere/edit.html.twig', [
            'enchere' => $enchere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enchere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Enchere $enchere): Response
    {
        if ($this->isCsrfTokenValid('delete' . $enchere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enchere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enchere_index');
    }
}
