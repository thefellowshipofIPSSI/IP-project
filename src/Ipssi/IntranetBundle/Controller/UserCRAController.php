<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\UserCRA;

use Ipssi\IntranetBundle\Form\UserCRAType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;



class UserCRAController extends Controller {

    /**
     * List all CRA in table
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra", name="intranet_cra_homepage")
     * @Method("GET")
     * @Security("has_role('ROLE_RH') or has_role('ROLE_EDIT_CRA') or has_role('ROLE_CREATE_CRA')")
     */
    public function indexAction() {

//        $allUserCRAs = $this->get('intranet.repository.cra')->findAll();
//
//        //Display only user's cra if ROLE_CREATE_CRA
//        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_CRA')) {
//            foreach ($allUserCRAs as $key => $userCRA) {
//                if ($userCRA->isCreator($this->getUser()) == false) {
//                    unset($allUserCRAs[$key]);
//                }
//            }
//        }
//
//        return $this->render('IntranetBundle:UserCRA:index.html.twig', [
//            'allUserCRAs' => $allUserCRAs
//        ]);

        $datatable = $this->get('app.datatable.usercra');
        $datatable->buildDatatable();

        return $this->render('IntranetBundle:UserCRA:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }


    /**
     * @Route("/cra/results", name="intranet_cra_results")
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.usercra');
        $datatable->buildDatatable();


        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        //Display only user's cra if ROLE_CREATE_CRA
//        if ($this->get('security.authorization_checker')->isGranted('ROLE_CREATE_CRA')) {
//            $query->buildQuery();
//            $qb = $query->getQuery();
//
//            $qb->andWhere("userCRA. = 11");
//        }
//


        return $query->getResponse();
    }

    /**
     * Create a new CRA
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra/create", name="intranet_cra_create", options={"expose"=true})
     * @Security("has_role('ROLE_RH') or has_role('ROLE_EDIT_CRA') or has_role('ROLE_CREATE_CRA')")
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
     * @Route("/cra/{id}/update", name="intranet_cra_update", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
     */
    public function updateAction(UserCRA $userCRA, Request $request)
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
     * @Route("/cra/{id}/delete", name="intranet_cra_delete", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
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
     * @Route("/cra/{id}/view", name="intranet_cra_view", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
     */
    public function viewAction(UserCRA $userCRA)
    {
        return $this->render('IntranetBundle:UserCRA:view.html.twig', [
            'userCRA' => $userCRA
        ]);
    }

    /**
     * Display a CRA's pdf
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cra/{id}/viewpdf", name="intranet_cra_view_pdf", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
     */
    public function viewpdfAction(UserCRA $userCRA)
    {
        $html = $this->renderView('IntranetBundle:UserCRA:viewPdf.html.twig', [
            'userCRA'  => $userCRA
        ]);

        $filename = "compte_rendu_" . $userCRA->getId();

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
     * Make a CRA online
     * @param $userCRA
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/cra/{id}/online", name="intranet_cra_online", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
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
     * @Route("/cra/{id}/offline", name="intranet_cra_offline", options={"expose"=true})
     * @Security("is_granted('edit', userCRA)")
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