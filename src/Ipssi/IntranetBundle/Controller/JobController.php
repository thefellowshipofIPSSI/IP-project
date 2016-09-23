<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\JobOffer;

use Ipssi\IntranetBundle\Form\JobOfferType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;


class JobOfferController extends Controller {

    /**
     * List all Pages in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $allJobOffers = $this->get('intranet.repository.jobOffer')->findAll();

        return $this->render('IntranetBundle:JobOffer:index.html.twig', [
            'allJobOffers' => $allJobOffers
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
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $page->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($page);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouvelle page créée !'
            );

            return $this->redirectToRoute('intranet_page_homepage');

        }

        return $this->render('IntranetBundle:Page:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing Page
     * @param $page_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($page_id, Request $request)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);

        $form = $this->createForm(PageType::class, $page);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($page);
            $em->flush();

            $this->addFlash(
                'success',
                'Page ' . $page->getName() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_page_homepage');

        }

        return $this->render('IntranetBundle:Page:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Page
     * @param $page_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($page);
        $em->flush();

        $this->addFlash(
            'success',
            'Page ' . $page->getName() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_page_homepage');
    }


    /**
     * Display a Page
     * @param $page_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);
        $pageTemplate = $page->getPageTemplate()->getName();

        return $this->render('IntranetBundle:Page\Templates:'. $pageTemplate .'.html.twig', [
            'page' => $page
        ]);
    }


    /**
     * Make a Page online
     * @param $page_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onlineAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:Page');

        $page = $pageRepo->find($page_id);
        $page->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($page);
        $em->flush();

        return $this->redirectToRoute('intranet_page_homepage');
    }

    /**
     * Make a Page offline
     * @param $page_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function offlineAction($page_id)
    {
        $pageRepo = $this->getDoctrine()->getRepository('IntranetBundle:page');

        $page = $pageRepo->find($page_id);
        $page->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($page);
        $em->flush();

        return $this->redirectToRoute('intranet_page_homepage');
    }

}
