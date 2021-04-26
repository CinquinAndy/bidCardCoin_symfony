<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adresse")
 */
class AdresseController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="adresse_index", methods={"GET"})
     */
    public function index(AdresseRepository $adresseRepository,int $numeroPage): Response
    {
        if($numeroPage<1){
            $numeroPage=0;
        }
        $endpage = (int)((($adresseRepository->findOneBy(array(),['id'=>'DESC'])->getId())/100));
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findBy(array(),array(),100,$numeroPage*100),
            'page'=>$numeroPage,
            'endpage'=>$endpage,
            'tabAttributes'=>['Id',
                'Pays',
                'Ville',
                'CodePostal',
                'Rue',
                'actions'],
            'route'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>0
            ]),
            'route_m2'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$numeroPage-2
            ]),
            'route_m1'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$numeroPage-1
            ]),
            'route_p0'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$numeroPage
            ]),
            'route_p1'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$numeroPage+1
            ]),
            'route_p2'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$numeroPage+2
            ]),
            'route_end'=>$this->generateUrl('adresse_index',[
                'numeroPage'=>$endpage
            ])
        ]);
    }

    /**
     * @Route("/new", name="adresse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adresse);
            $entityManager->flush();

            return $this->redirectToRoute('adresse_index');
        }

        return $this->render('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adresse_show", methods={"GET"})
     */
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adresse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adresse $adresse): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adresse_index');
        }

        return $this->render('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adresse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Adresse $adresse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adresse_index');
    }

    public function test() : string {
        echo "coucou";
        return "coucou toi";
    }
}
