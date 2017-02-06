<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\Page;

use Ipssi\IntranetBundle\Form\PageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller {

    /**
     * List all Pages in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page", name="intranet_page_homepage")
     */
    public function indexAction() {

        $datatable = $this->get('app.datatable.page');
        $datatable->buildDatatable();

        return $this->render('IntranetBundle:Page:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/page/results", name="intranet_page_results", options={"expose"=true})
     */
    public function indexResultsAction() {
        $datatable = $this->get('app.datatable.page');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Create a new Page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/create", name="intranet_page_create", options={"expose"=true})
     * @Security("has_role('ROLE_REDACTEUR')")
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
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/{id}/update", name="intranet_page_update", options={"expose"=true})
     * @Security("is_granted('edit', page) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function updateAction(Page $page, Request $request)
    {
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
     * @param $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/page/{id}/delete", name="intranet_page_delete", options={"expose"=true})
     * @Security("is_granted('edit', page) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(Page $page)
    {
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
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/{id}/view", name="intranet_page_view", options={"expose"=true})
     */
    public function viewAction(Page $page)
    {
        $pageTemplate = $page->getPageTemplate()->getName();

        return $this->render('IntranetBundle:Page\Templates:'. $pageTemplate .'.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * Make a Page online
     * @param $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/page/{id}/online", name="intranet_page_online", options={"expose"=true})
     * @Security("is_granted('edit', page) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function onlineAction(Page $page)
    {
        $page->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($page);
        $em->flush();

        $this->addFlash(
            'success',
            'Page ' . $page->getName() . ' mise en ligne'
        );

        return $this->redirectToRoute('intranet_page_homepage');
    }

    /**
     * Make a Page offline
     * @param $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/page/{id}/offline", name="intranet_page_offline", options={"expose"=true})
     * @Security("is_granted('edit', page) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function offlineAction(Page $page)
    {
        $page->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($page);
        $em->flush();

        $this->addFlash(
            'success',
            'La Page ' . $page->getName() . ' n\'est plus visible sur le site !'
        );

        return $this->redirectToRoute('intranet_page_homepage');
    }

}
