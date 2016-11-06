<?php

namespace AppBundle\Controller;

use AppBundle\Entity\komentari;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CommentController extends Controller
{


	/**
     * @Route("/", name="autori_list")
     */
    public function listAction()
    {
       $autori = $this->getDoctrine()->getRepository('AppBundle:komentari')->findBy(array(), array('autor' => 'asc'));
      
        // replace this example code with whatever you need
        return $this->render('app/index.html.twig', array(
            'autori'=>$autori
            ));
    }


	/**
     * @Route("/app/add_comment", name="add_comment")
     */

    public function add_commentAction(Request $request)
    {

	$nkomentar= new komentari;

           
            $form = $this -> createFormBuilder($nkomentar)
        
            ->add('komentar', TextareaType::class, array('attr'=> array('class'=> 'form-control', 'style' => 'margin-bottom:15px')))

            ->add('autor', TextType::class, array('attr'=> array('class'=> 'form-control', 'style' => 'margin-bottom:15px')))

            
            ->add('save', SubmitType::class, array('label'=>'Dodaj komentar','attr'=> array('class'=> 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();
           
            $form->handleRequest($request);
           

            if($form->isSubmitted() && $form->isValid()){

            	$komentar= $form['komentar']->getData();
                $autor= $form['autor']->getData();
                
              
                $now = new\Datetime('now');

                $nkomentar->setKomentar($komentar);
                $nkomentar->setAutor($autor);
                $nkomentar->setCreatedat($now);

                $em = $this->getDoctrine()->getManager();

                $em->persist($nkomentar);

                $em->flush();

                $this->addFlash(
                    'notice',
                    'Hvala Vam na komentaru'
                    );
                return $this->redirectToRoute('autori_list');


            }


        
            return $this->render('/app/add_comment.html.twig', array (
            'form'=>
            $form->createView()
            ));
        }


        /**
     * @Route("/app/view/{autor}", name="app_view")
     */

    public function viewAction(Request $request, $autor)
  
    {




       $komentar = $this->getDoctrine()->getRepository('AppBundle:komentari')->findBy(array('autor' => ($autor)), array('createdAt' => 'DESC'));

        /**
        *@var $paginator \Knp\Component\Pager\paginator
        */

       $paginator = $this->get('knp_paginator');

        $result= $paginator->paginate(
            $komentar,
            $request->query->getInt('page',1),
            $request->query->getInt('limit', 3)

            );


       dump(get_class($paginator));
       
        return $this->render('app/view.html.twig', array(
            'autori'=>$result , 
           
            ));
    }


 
}    