<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserVacation;

use Ipssi\IntranetBundle\Form\UserVacationType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserVacationController extends Controller {

    /**
     * List all Vacation in table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        $allUserVacations = $this->get('intranet.repository.vacation')->findAll();

        return $this->render('IntranetBundle:UserVacation:index.html.twig', [
            'allUserVacations' => $allUserVacations
        ]);
    }

    /**
     * Create a new Vacation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $userVacation = new UserVacation;

        $form = $this->createForm(UserVacationType::class, $userVacation);
        $form->add('save', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userVacation = $form->getData();
            $userVacation->setUser($this->getUser());

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userVacation);
            $em->flush();

            $this->addFlash(
                'success',
                'Demande de congés créée !'
            );

            return $this->redirectToRoute('intranet_vacation_homepage');

        }

        return $this->render('IntranetBundle:UserVacation:create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Update existing Vacation
     * @param $vacation_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($vacation_id, Request $request)
    {
        $userVacationRepo = $this->get('intranet.repository.vacation');

        $userVacation = $userVacationRepo->find($vacation_id);

        $form = $this->createForm(UserVacationType::class, $userVacation);
        $form->add('save', SubmitType::class, [
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userVacation = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($userVacation);
            $em->flush();

            $this->addFlash(
                'success',
                'Demande de congés modifiée !'
            );

            return $this->redirectToRoute('intranet_vacation_homepage');

        }

        return $this->render('IntranetBundle:UserVacation:update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Delete a Vacation
     * @param $vacation_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($vacation_id)
    {
        $userVacationRepo = $this->get('intranet.repository.vacation');

        $userVacation = $userVacationRepo->find($vacation_id);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($userVacation);
        $em->flush();

        $this->addFlash(
            'success',
            'Demande de congés supprimée'
        );

        return $this->redirectToRoute('intranet_vacation_homepage');
    }


    /**
     * Display a Vacation
     * @param $vacation_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($vacation_id)
    {
        $userVacationRepo = $this->get('intranet.repository.vacation');

        $userVacation = $userVacationRepo->find($vacation_id);

        return $this->render('IntranetBundle:UserVacation:view.html.twig', [
            'userVacation' => $userVacation
        ]);
    }


    /**
     * Make a Vacation online
     * @param $vacation_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onlineAction($vacation_id)
    {
        $userVacationRepo = $this->get('intranet.repository.vacation');

        $userVacation = $userVacationRepo->find($vacation_id);
        $userVacation->setStatus(1);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userVacation);
        $em->flush();

        $this->addFlash(
            'success',
            'Demande de congés mise en ligne'
        );

        return $this->redirectToRoute('intranet_vacation_homepage');
    }

    /**
     * Make a Vacation offline
     * @param $vacation_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function offlineAction($vacation_id)
    {
        $userVacationRepo = $this->get('intranet.repository.vacation');

        $userVacation = $userVacationRepo->find($vacation_id);
        $userVacation->setStatus(0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($userVacation);
        $em->flush();

        $this->addFlash(
            'success',
            'La demande de congés n\'est plus visible sur le site !'
        );

        return $this->redirectToRoute('intranet_vacation_homepage');
    }

}
