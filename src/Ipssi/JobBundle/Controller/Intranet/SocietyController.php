<?php


namespace Ipssi\JobBundle\Controller\Intranet;

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


    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $society = new Society();

        $form = $this->createForm(SocietyType::class);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Créer',
            'attr'  => array('class' => 'btn btn-success')
        ));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $society = $form->getData();

            $em->persist($society);
            $em->flush();

        }


        return $this->render('JobBundle:Intranet/Society:create.html.twig', array(
            'society' => $society,
            'form' => $form->createView()
        ));


    }


    public function updateAction(Request $request)
    {

    }


    public function deleteAction(Request $request)
    {

    }

}