<?php

namespace App\Controller;

use App\Entity\Lot;
use App\Form\LotType;
use App\Repository\LotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lot")
 */
class LotController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="lot_index", methods={"GET"})
     */
    public function index(LotRepository $lotRepository,int $numeroPage): Response
    {
        if($numeroPage<1){
            $numeroPage=0;
        }
        $endpage = (int)((($lotRepository->findOneBy(array(),['id'=>'DESC'])->getId())/100));
        return $this->render('lot/index.html.twig', [
            'lots' => $lotRepository->findBy(array(),array(),100,$numeroPage*100),
            'page'=>$numeroPage,
            'endpage'=>$endpage,
            'tabAttributes'=>['Id',
                'Nom',
                'Description',
                'Photo',
                'Actions'
            ],
            'route'=>$this->generateUrl('lot_index',[
                'numeroPage'=>0
            ]),
            'route_m2'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$numeroPage-2
            ]),
            'route_m1'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$numeroPage-1
            ]),
            'route_p0'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$numeroPage
            ]),
            'route_p1'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$numeroPage+1
            ]),
            'route_p2'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$numeroPage+2
            ]),
            'route_end'=>$this->generateUrl('lot_index',[
                'numeroPage'=>$endpage
            ])
        ]);
    }

    /**
     * @Route("/new", name="lot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lot = new Lot();
        $form = $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lot);
            $entityManager->flush();

            return $this->redirectToRoute('lot_index');
        }

        return $this->render('lot/new.html.twig', [
            'lot' => $lot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lot_show", methods={"GET"})
     */
    public function show(Lot $lot): Response
    {
        $produitTab=array();
        foreach ($lot->getProduit() as $produit){
            $produitTab[]=$produit;
        }
        return $this->render('lot/show.html.twig', [
            'lot' => $lot,
            'produitTab'=>$produitTab,
            'venteId'=>$lot->getVente()->getId(),
            'enchereValue'=>$lot->getBiggestEnchere()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lot $lot): Response
    {
        $form = $this->createForm(LotType::class, $lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lot_index');
        }

        return $this->render('lot/edit.html.twig', [
            'lot' => $lot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lot $lot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lot_index');
    }
}
