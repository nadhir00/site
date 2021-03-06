<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads/{page<\d+>?1}", name="admin_ads_index")
     */
    public function index(AdRepository $repo,$page=1): Response
    {
        $limit =10;
        $start = $page * $limit -$limit;
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);


        return $this->render('admin/admin_ad/index.html.twig', [
            'ads' => $repo->findBy([],[],$limit,$start),
            'pages' => $pages,
            'page' => $page
        ]);
    }


    /**
     * Permet d'afficher le formulaire d'édition
     * 
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request) {
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                " <center><strong> الاجابة تمت بناجح </strong></center>"
            );
        }

        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);
    }
     /**
     * Permet de supprimer une annonce
     * 
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     *
     * @param Ad $ad
     * @return Response
     */
    public function delete(Ad $ad) {
       
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "المشكل تم فسخه بنجاح  "
            );
      

        return $this->redirectToRoute('admin_ads_index');
    }
    
}

