<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserVacation;

use Ipssi\IntranetBundle\Form\UserVacationType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;


class UserVacationController extends Controller {

    /**
     * List all Vacation in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/vacation", name="intranet_vacation_homepage")
     * @Security("has_role('ROLE_RH') or has_role('ROLE_EDIT_VACATION') or has_role('ROLE_CREATE_VACATION')")
     */
    public function indexAction() {

//        $allUserVacations = $this->get('intranet.repository.vacation')->findAll();
//
//        //Display only user's cra if ROLE_CREATE_VACATION
//        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_VACATION')) {
//            foreach ($allUserVacations as $key => $userVacation) {
//                if ($userVacation->isCreator($this->getUser()) == false) {
//                    unset($allUserVacations[$key]);
//                }
//            }
//        }
//
//        return $this->render('IntranetBundle:UserVacation:index.html.twig', [
//            'allUserVacations' => $allUserVacations
//        ]);

        $datatable = $this->get('app.datatable.uservacation');
        $datatable->buildDatatable();

        return $this->render('IntranetBundle:UserVacation:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/vacation/results", name="intranet_vacation_results", options={"expose"=true})
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.uservacation');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        //Display only user's vacation if ROLE_CREATE_VACATION
        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_VACATION')) {
            $query->buildQuery();
            $qb = $query->getQuery();
            $user = $this->getUser()->getId();
            $qb->andWhere("user_vacation.user = " . $user);

            return $query->getResponse(false);
        } else {
            return $query->getResponse();
        }
    }

    /**
     * Create a new Vacation
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/vacation/create", name="intranet_vacation_create", options={"expose"=true})
     * @Security("has_role('ROLE_RH') or has_role('ROLE_EDIT_VACATION') or has_role('ROLE_CREATE_VACATION')")
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
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/vacation/{id}/update", name="intranet_vacation_update", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function updateAction(UserVacation $userVacation, Request $request)
    {
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
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/vacation/{id}/delete", name="intranet_vacation_delete", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function deleteAction(UserVacation $userVacation)
    {
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
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/vacation/{id}/view", name="intranet_vacation_view", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function viewAction(UserVacation $userVacation)
    {
        return $this->render('IntranetBundle:UserVacation:view.html.twig', [
            'userVacation' => $userVacation
        ]);
    }

    /**
     * Display a vacation's pdf
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/vacation/{id}/viewpdf", name="intranet_vacation_view_pdf", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function viewPdfAction(UserVacation $userVacation)
    {
        $html = $this->renderView('IntranetBundle:UserVacation:viewPdf.html.twig', array(
            'userVacation'  => $userVacation
        ));

        $filename = "Demande_conge_" . $userVacation->getId();

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'".pdf"'
            )
        );
    }


    /**
     * Make a Vacation online
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/vacation/{id}/online", name="intranet_vacation_online", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function onlineAction(UserVacation $userVacation)
    {
        $userVacation->setStatus(1);
        $userVacation->setUserValidation($this->getUser());

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
     * @param $userVacation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/vacation/{id}/offline", name="intranet_vacation_offline", options={"expose"=true})
     * @Security("is_granted('edit', userVacation)")
     */
    public function offlineAction(UserVacation $userVacation)
    {
        $userVacation->setStatus(2);
        $userVacation->setUserValidation($this->getUser());

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
