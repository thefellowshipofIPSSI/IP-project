<?php


namespace Ipssi\JobBundle\Controller\Intranet;

use Ipssi\IpssiBundle\Entity\File;
use Ipssi\JobBundle\Entity\Society;
use Ipssi\JobBundle\Form\SocietyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SocietyController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $societies = $em->getRepository('JobBundle:Society')->findAll();


        return $this->render('JobBundle:Intranet/Society:index.html.twig', array(
            'societies' => $societies
        ));

    }


    public function viewAction($society)
    {
        $em = $this->getDoctrine()->getManager();

        $society = $em->getRepository('JobBundle:Society')->find($society);


        return $this->render('JobBundle:Intranet/Society:view.html.twig', array(
            'society' => $society
        ));

    }


    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $society = new Society();


        $form = $this->createForm(SocietyType::class, $society);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $society = $form->getData();

            $file = $society->getLogo();


            $em->persist($society);
            $em->persist($file);
            $em->flush();


            $this->addFlash(
                'success',
                'Nouvelle société créée !'
            );

            return $this->redirectToRoute('intranet_societies');

        }


        return $this->render('JobBundle:Intranet/Society:update.html.twig', array(
            'society' => $society,
            'form' => $form->createView()
        ));


    }


    public function updateAction(Request $request, $society)
    {
        $em = $this->getDoctrine()->getManager();

        $society = $em->getRepository('JobBundle:Society')->find($society);


        $form = $this->createForm(SocietyType::class, $society);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer',
            'attr'  => array('class' => 'btn btn-success')
        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $society = $form->getData();

            $file = $society->getLogo();


            $em->persist($society);
            $em->persist($file);
            $em->flush();


            $this->addFlash(
                'success',
                'Société modifiée !'
            );

            return $this->redirectToRoute('intranet_societies');

        }


        return $this->render('JobBundle:Intranet/Society:update.html.twig', array(
            'society' => $society,
            'form' => $form->createView()
        ));

    }


    public function deleteAction($society)
    {
        $em = $this->getDoctrine()->getManager();

        $society = $em->getRepository('JobBundle:Society')->find($society);

        $em->remove($society);

        $em->flush();


        $this->addFlash(
            'danger',
            'Société supprimée'
        );

        return $this->redirectToRoute('intranet_societies');
    }

}