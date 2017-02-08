<?php

namespace Ipssi\JobBundle\Controller\Intranet;

use Ipssi\JobBundle\Entity\CV;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Cv controller.
 *
 * @Route("intranet/cv")
 */
class CVController extends Controller
{
    /**
     * Lists all cV entities.
     *
     * @Route("/", name="cv_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cVs = $em->getRepository('JobBundle:CV')->findAll();

        return $this->render('JobBundle:Intranet/cv/index.html.twig', array(
            'cVs' => $cVs,
        ));
    }

    /**
     * Creates a new cV entity.
     *
     * @Route("/new", name="cv_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cV = new Cv();
        $form = $this->createForm('Ipssi\JobBundle\Form\CVType', $cV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cV);
            $em->flush($cV);

            return $this->redirectToRoute('cv_show', array('id' => $cV->getId()));
        }

        return $this->render('JobBundle:Intranet/cv/new.html.twig', array(
            'cV' => $cV,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cV entity.
     *
     * @Route("/{id}", name="cv_show")
     * @Method("GET")
     */
    public function showAction(CV $cV)
    {
        $deleteForm = $this->createDeleteForm($cV);

        return $this->render('JobBundle:Intranet/cv/show.html.twig', array(
            'cV' => $cV,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cV entity.
     *
     * @Route("/{id}/edit", name="cv_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CV $cV)
    {
        $deleteForm = $this->createDeleteForm($cV);
        $editForm = $this->createForm('Ipssi\JobBundle\Form\CVType', $cV);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_edit', array('id' => $cV->getId()));
        }

        return $this->render('JobBundle:Intranet/cv/edit.html.twig', array(
            'cV' => $cV,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cV entity.
     *
     * @Route("/{id}", name="cv_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CV $cV)
    {
        $form = $this->createDeleteForm($cV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cV);
            $em->flush($cV);
        }

        return $this->redirectToRoute('cv_index');
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
