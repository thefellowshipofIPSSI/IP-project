<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * Intranet Homepage
     * @Route("/", name="intranet_homepage")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        foreach ($user->getGroups() as $group) {
            $group = $group->getId();
        }

        if (!isset($group)) {

            $em = $this->getDoctrine()->getEntityManager();
            $repositoryG = $this->get('user.repository.group');
            $group = $repositoryG->findOneByName('Collaborateur');

            $user->addGroup($group);

            $em->persist($user);
            $em->flush();
        }

        return $this->render('IntranetBundle:Default:index.html.twig');
    }
}