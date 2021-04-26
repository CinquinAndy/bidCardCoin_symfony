<?php

namespace App\Controller;

use App\Entity\Estimation;
use App\Form\EstimationType;
use App\Repository\EstimationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estimation")
 */
class EstimationController extends AbstractController
{
    /**
     * @Route("/page/{numeroPage?0}", name="estimation_index", methods={"GET"})
     */
    public function index(EstimationRepository $estimationRepository,int $numeroPage): Response
    {
        if($numeroPage<1){
            $numeroPage=0;
        }
        $endpage = (int)((($estimationRepository->findOneBy(array(),['id'=>'DESC'])->getId())/100));
        return $this->render('estimation/index.html.twig', [
            'estimations' => $estimationRepository->findBy(array(),array(),100,$numeroPage*100),
            'page'=>$numeroPage,
            'endpage'=>$endpage,
            'tabAttributes'=>['Id',
                'Date',
                'Prix',
                'Actions'
            ],
            'route'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>0
            ]),
            'route_m2'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$numeroPage-2
            ]),
            'route_m1'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$numeroPage-1
            ]),
            'route_p0'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$numeroPage
            ]),
            'route_p1'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$numeroPage+1
            ]),
            'route_p2'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$numeroPage+2
            ]),
            'route_end'=>$this->generateUrl('estimation_index',[
                'numeroPage'=>$endpage
            ])
        ]);
    }

    /**
     * @Route("/new", name="estimation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estimation = new Estimation();
        $form = $this->createForm(EstimationType::class, $estimation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estimation);
            $entityManager->flush();

            return $this->redirectToRoute('estimation_index');
        }

        return $this->render('estimation/new.html.twig', [
            'estimation' => $estimation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimation_show", methods={"GET"})
     */
    public function show(Estimation $estimation): Response
    {
        return $this->render('estimation/show.html.twig', [
            'estimation' => $estimation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estimation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estimation $estimation): Response
    {
        $form = $this->createForm(EstimationType::class, $estimation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estimation_index');
        }

        return $this->render('estimation/edit.html.twig', [
            'estimation' => $estimation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estimation $estimation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estimation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estimation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estimation_index');
    }
}
