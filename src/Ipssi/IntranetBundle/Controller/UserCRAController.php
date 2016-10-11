<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserCRA;

use Ipssi\IntranetBundle\Form\UserCRAType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserCRAController extends Controller {

    /**
     * List all CRA in table
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param $cra_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($cra_id, Request $request)
    {
        $userCRARepo = $this->get('intranet.repository.cra');

        $userCRA = $userCRARepo->find($cra_id);

        //check if current user can edit
        $this->denyAccessUnlessGranted('edit', $userCRA);

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
     * @param $cra_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($cra_id)
    {
        $userCRARepo = $this->get('intranet.repository.cra');

        $userCRA = $userCRARepo->find($cra_id);

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
     * @param $cra_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($cra_id)
    {
        $userCRARepo = $this->get('intranet.repository.cra');

        $userCRA = $userCRARepo->find($cra_id);

        return $this->render('IntranetBundle:UserCRA:view.html.twig', [
            'userCRA' => $userCRA
        ]);
    }


    /**
     * Make a CRA online
     * @param $cra_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onlineAction($cra_id)
    {
        $userCRARepo = $this->get('intranet.repository.cra');

        $userCRA = $userCRARepo->find($cra_id);
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
     * @param $cra_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function offlineAction($cra_id)
    {
        $userCRARepo = $this->get('intranet.repository.cra');

        $userCRA = $userCRARepo->find($cra_id);
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
