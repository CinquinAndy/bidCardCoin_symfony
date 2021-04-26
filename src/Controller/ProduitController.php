<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository,int $numeroPage): Response
    {
        if($numeroPage<1){
            $numeroPage=0;
        }
        $endpage = (int)((($produitRepository->findOneBy(array(),['id'=>'DESC'])->getId())/100));
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findBy(array(),array(),100,$numeroPage*100),
            'page'=>$numeroPage,
            'endpage'=>$endpage,
            'tabAttributes'=>['Id',
                'NomArtiste',
                'NomStyle',
                'NomProduit',
                'PrixReserve',
                'ReferenceCatalogue',
                'Description',
                'EstEnvoyer',
                'Photo',
                'Actions'
            ],
            'route'=>$this->generateUrl('produit_index',[
                'numeroPage'=>0
            ]),
            'route_m2'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$numeroPage-2
            ]),
            'route_m1'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$numeroPage-1
            ]),
            'route_p0'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$numeroPage
            ]),
            'route_p1'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$numeroPage+1
            ]),
            'route_p2'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$numeroPage+2
            ]),
            'route_end'=>$this->generateUrl('produit_index',[
                'numeroPage'=>$endpage
            ])
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
}
