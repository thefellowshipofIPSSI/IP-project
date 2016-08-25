<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\Page;

use Ipssi\IntranetBundle\Form\PageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PageController extends Controller
{
    /**
     * List all Page in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $allPages = $pageRepo->findAll();

        return $this->render('IntranetBundle:Page:index.html.twig', [
            'allPages' => $allPages
        ]);
    }

    /**
     * Create a new Page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $page = new Page;

        $form = $this->createForm(PageType::class, $page);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer'
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();


            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($page);
            $em->flush();

        }


        return $this->render('IntranetBundle:Page:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);
        dump($page);die;
    }

    public function viewAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);
        dump($page);die;
    }
}
