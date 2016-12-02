<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserCRA;

use Ipssi\IntranetBundle\Form\UserCRAType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UserCRAController extends Controller {

    /**
     * List all CRA in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra", name="intranet_cra_homepage")
     */
    public function indexAction() {

        $allUserCRAs = $this->get('intranet.repository.cra')->findAll();

        return $this->render('IntranetBundle:UserCRA:index.html.twig', [
            'allUserCRAs' => $allUserCRAs
        ]);
    }

    /**
     * Create a new CRA
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra/create", name="intranet_cra_create")
     */
    public function createAction(Request $request) {
        $userCRA = new UserCRA;

        $form = $this->createForm(UserCRAType::class, $userCRA);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userCRA = $form->getData();
            $userCRA->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userCRA);
            $em->flush();

            $this->addFlash(
                'success',
                'Nouveau compte rendu d\'activité créée !'
            );

            return $this->redirectToRoute('intranet_cra_homepage');

        }

        return $this->render('IntranetBundle:UserCRA:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing CRA
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra/{id}/update", name="intranet_cra_update")
     */
    public function updateAction(userCRA $userCRA, Request $request)
    {
        $form = $this->createForm(UserCRAType::class, $userCRA);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userCRA = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userCRA);
            $em->flush();

            $this->addFlash(
                'success',
                'Compte rendu d\'activité ' . $userCRA->getProjectName() . ' modifiée !'
            );

            return $this->redirectToRoute('intranet_cra_homepage');

        }

        return $this->render('IntranetBundle:UserCRA:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a CRA
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/cra/{id}/delete", name="intranet_cra_delete")
     */
    public function deleteAction(UserCRA $userCRA)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($userCRA);
        $em->flush();

        $this->addFlash(
            'success',
            'Compte rendu d\'activité ' . $userCRA->getProjectName() . ' supprimé'
        );

        return $this->redirectToRoute('intranet_cra_homepage');
    }


    /**
     * Display a CRA
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra/{id}/view", name="intranet_cra_view")
     */
    public function viewAction(UserCRA $userCRA)
    {
        return $this->render('IntranetBundle:UserCRA:view.html.twig', [
            'userCRA' => $userCRA
        ]);
    }


    /**
     * Make a CRA online
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/cra/{id}/online", name="intranet_cra_online")
     */
    public function onlineAction(UserCRA $userCRA)
    {
        $userCRA->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userCRA);
        $em->flush();

        $this->addFlash(
            'success',
            'Compte rendu d\'activité ' . $userCRA->getProjectName() . ' mis en ligne'
        );

        return $this->redirectToRoute('intranet_cra_homepage');
    }

    /**
     * Make a CRA offline
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/cra/{id}/offline", name="intranet_cra_offline")
     */
    public function offlineAction(UserCRA $userCRA)
    {
        $userCRA->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userCRA);
        $em->flush();

        $this->addFlash(
            'success',
            'Le compte rendu d\'activité ' . $userCRA->getProjectName() . ' n\'est plus visible sur le site !'
        );

        return $this->redirectToRoute('intranet_cra_homepage');
    }

}
