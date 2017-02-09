<?php

namespace Ipssi\JobBundle\Controller\Intranet;

use Ipssi\JobBundle\Entity\CV;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


/**
 * Cv controller.
 */
class CVController extends Controller
{
    /**
     * Lists all cV entities.
     *
     * @Method("GET")
     */
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//
//        $cVs = $em->getRepository('JobBundle:CV')->findAll();
//
//        return $this->render('JobBundle:Intranet/cv:index.html.twig', array(
//            'cVs' => $cVs,
//        ));

        $datatable = $this->get('app.datatable.cv');
        $datatable->buildDatatable();

        return $this->render('JobBundle:Intranet/cv:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.cv');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new cV entity.
     *
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cV = new Cv();
        $form = $this->createForm('Ipssi\JobBundle\Form\CVType', $cV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $cV->setUser($this->getUser());
            $em->persist($cV);
            $em->flush($cV);

            return $this->redirectToRoute('user_profile');
        }

        return $this->render('JobBundle:Intranet/cv:new.html.twig', array(
            'cV' => $cV,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cV entity.
     *
     * @Method("GET")
     */
    public function showAction(CV $cV)
    {
        $deleteForm = $this->createDeleteForm($cV);

        return $this->render('JobBundle:Intranet/cv:show.html.twig', array(
            'cV' => $cV,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cV entity.
     *
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CV $cV)
    {
        $deleteForm = $this->createDeleteForm($cV);
        $editForm = $this->createForm('Ipssi\JobBundle\Form\CVType', $cV);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_profile');
        }

        return $this->render('JobBundle:Intranet/cv:edit.html.twig', array(
            'cV' => $cV,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cV entity.
     *
     * @Method("DELETE")
     */
    public function deleteAction(CV $cV)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cV);
        $em->flush();

        $this->addFlash(
            'success',
            'Cv supprimé !'
        );

        return $this->redirectToRoute('user_profile');
    }

    /**
     * Creates a form to delete a cV entity.
     *
     * @param CV $cV The cV entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CV $cV)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cv_delete', array('id' => $cV->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
