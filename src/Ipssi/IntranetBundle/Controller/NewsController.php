<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\News;

use Ipssi\IntranetBundle\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class NewsController extends Controller {

    /**
     * List all News in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $newsRepo = $this->getDoctrine()->getRepository('IntranetBundle:News');

        $allNews = $newsRepo->findAll();

        return $this->render('IntranetBundle:News:index.html.twig', [
            'allNews' => $allNews
        ]);
    }

    /**
     * Create a new News
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $news = new News;

        $form = $this->createForm(NewsType::class, $news);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer'
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $news = $form->getData();


            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($news);
            $em->flush();

        }
        
        
        return $this->render('IntranetBundle:News:form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateAction($news_id)
    {
        $newsRepo = $this->getDoctrine()->getRepository('IntranetBundle:News');

        $news = $newsRepo->find($news_id);
        dump($news);die;
    }

    public function viewAction($news_id)
    {
        $newsRepo = $this->getDoctrine()->getRepository('IntranetBundle:News');

        $news = $newsRepo->find($news_id);
        dump($news);die;
    }

}
