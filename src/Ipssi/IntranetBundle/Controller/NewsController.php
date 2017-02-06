<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\News;

use Ipssi\IntranetBundle\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class NewsController extends Controller {

    /**
     * List all News in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/news", name="intranet_news_homepage")
     * @Security("has_role('ROLE_REDACTEUR')")
     */
    public function indexAction() {

        $datatable = $this->get('app.datatable.news');
        $datatable->buildDatatable();

        return $this->render('IntranetBundle:News:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/news/results", name="intranet_news_results")
     */
    public function indexResultsAction() {
        $datatable = $this->get('app.datatable.news');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }


    /**
     * Create a new News
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/news/create", name="intranet_news_create", options={"expose"=true})
     * @Security("has_role('ROLE_REDACTEUR')")
     */
    public function createAction(Request $request) {
        $news = new News;

        $form = $this->createForm(NewsType::class, $news);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $news = $form->getData();
            $news->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($news);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouvelle actualité créée !'
            );

            return $this->redirectToRoute('intranet_news_homepage');

        }
        
        return $this->render('IntranetBundle:News:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing News
     * @param $news
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/news/{id}/update", name="intranet_news_update", options={"expose"=true})
     * @Security("is_granted('edit', news) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function updateAction(Request $request, News $news)
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $news = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($news);
            $em->flush();

            $this->addFlash(
                'success',
                'Actualité ' . $news->getName() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_news_homepage');

        }

        return $this->render('IntranetBundle:News:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a News
     * @param $news
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/news/{id}/delete", name="intranet_news_delete", options={"expose"=true})
     * @Security("is_granted('edit', news) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(News $news)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($news);
        $em->flush();

        $this->addFlash(
            'success',
            'Actualité ' . $news->getName() . ' supprimée'
        );

        return $this->redirectToRoute('intranet_news_homepage');
    }


    /**
     * Display a News
     * @param $news
     * @Route("/news/{id}/view", name="intranet_news_view", options={"expose"=true})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(News $news)
    {
        return $this->render('IntranetBundle:News:view.html.twig', [
            'news' => $news
        ]);
    }


    /**
     * Make a News online
     * @param $news
     * @Route("/news/{id}/online", name="intranet_news_online", options={"expose"=true})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('edit', news) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function onlineAction(News $news)
    {
        $news->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $em->flush();

        $this->addFlash(
            'success',
            'Actualité ' . $news->getName() . ' mise en ligne'
        );

        return $this->redirectToRoute('intranet_news_homepage');
    }

    /**
     * Make a News offline
     * @param $news
     * @Route("/news/{id}/offline", name="intranet_news_offline", options={"expose"=true})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('edit', news) or has_role('ROLE_SUPER_ADMIN')")
     */
    public function offlineAction(News $news)
    {
        $news->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'Actualité ' . $news->getName() . ' n\'est plus visible sur le site'
        );

        return $this->redirectToRoute('intranet_news_homepage');
    }

}
