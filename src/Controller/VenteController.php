<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Form\VenteType;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vente")
 */
class VenteController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="vente_index", methods={"GET"})
     */
    public function index(VenteRepository $venteRepository,int $numeroPage): Response
    {
        if($numeroPage<1){
            $numeroPage=0;
        }
        $endpage = (int)((($venteRepository->findOneBy(array(),['id'=>'DESC'])->getId())/100));
        return $this->render('vente/index.html.twig', [
            'ventes' => $venteRepository->findBy(array(),array(),100,$numeroPage*100),
            'page'=>$numeroPage,
            'endpage'=>$endpage,
            'tabAttributes'=>['Id',
                'DateDebut',
                'Actions'
            ],
            'route'=>$this->generateUrl('vente_index',[
                'numeroPage'=>0
            ]),
            'route_m2'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$numeroPage-2
            ]),
            'route_m1'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$numeroPage-1
            ]),
            'route_p0'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$numeroPage
            ]),
            'route_p1'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$numeroPage+1
            ]),
            'route_p2'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$numeroPage+2
            ]),
            'route_end'=>$this->generateUrl('vente_index',[
                'numeroPage'=>$endpage
            ])
        ]);
    }

    /**
     * @Route("/new", name="vente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vente = new Vente();
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vente);
            $entityManager->flush();

            return $this->redirectToRoute('vente_index');
        }

        return $this->render('vente/new.html.twig', [
            'vente' => $vente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vente_show", methods={"GET"})
     */
    public function show(Vente $vente): Response
    {
        return $this->render('vente/show.html.twig', [
            'vente' => $vente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vente $vente): Response
    {
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vente_index');
        }

        return $this->render('vente/edit.html.twig', [
            'vente' => $vente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vente $vente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vente_index');
    }
}
