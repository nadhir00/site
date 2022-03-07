<?php

namespace App\Controller;

use App\Entity\Neww;
use App\Form\NewwType;
use App\Repository\AdRepository;
use App\Repository\NewwRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewController extends AbstractController
{
  /**
     * @Route("/new", name="new_index")
     */
    public function index(NewwRepository $repo)
    {   
       
        $news = $repo->findAll();
        
        return $this->render('admin/new/index.html.twig', [
            'news' => $news
        ]);
    }
    /**
     * permet créer une new
     * 
     * @Route("/admin/new",name="new_create")
     * 
     * 
     */
    public function create(Request $request){    
        $new = new Neww();
        $form = $this->createForm(NewwType::class,$new);
        $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($new);
                    $manager->flush();    
                    $this->addFlash(
                        'success',
                        "Actualité numéro <strong>{$new->getId()}</strong> a été ajouté avec succée "
                    );
                    return $this->redirectToRoute('new_show',[
                        'id' => $new->getId()
                    ]);
                }             
        return $this->render('admin/new/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
    * permet d'afficher chkeya
    *  
    * @Route("/new/{id}",name="new_show")
    */
     public function show($id, Neww $new){
      // je recupére l a new bil id
        //$ad = $repo->findOneById($id);
          return $this->render('admin/new/show.html.twig', [
                'new' => $new
            ]);

        }
}
