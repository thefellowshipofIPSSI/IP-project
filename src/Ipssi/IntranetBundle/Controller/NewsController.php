<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\News;

use Ipssi\IntranetBundle\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class NewsController extends Controller {

    /**
     * List all News in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $allNews = $this->get('intranet.repository.news')->findAll();

        return $this->render('IntranetBundle:News:index.html.twig', [
            'allNews' => $allNews
        ]);
    }


    /**
     * Create a new News
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_REDACTEUR') and is_granted('create')")
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
     * @param $news_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_SUPER_ADMIN') or has_role('ROLE_REDACTEUR')")
     */
    public function updateAction($news_id, Request $request)
    {
        $newsRepo = $this->get('intranet.repository.news');

        $news = $newsRepo->find($news_id);

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
     * @param $news_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('edit', news_id)")
     */
    public function deleteAction($news_id)
    {
        $newsRepo = $this->get('intranet.repository.news');

        $news = $newsRepo->find($news_id);

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
     * @param $news_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($news_id)
    {
        $newsRepo = $this->get('intranet.repository.news');

        $news = $newsRepo->find($news_id);


        return $this->render('IntranetBundle:News:view.html.twig', [
            'news' => $news
        ]);
    }


    /**
     * Make a News online
     * @param $news_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('edit', news_id)")
     */
    public function onlineAction($news_id)
    {
        $newsRepo = $this->get('intranet.repository.news');

        $news = $newsRepo->find($news_id);
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
     * @param $news_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('edit', news_id)")
     */
    public function offlineAction($news_id)
    {
        $newsRepo = $this->get('intranet.repository.news');

        $news = $newsRepo->find($news_id);
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
