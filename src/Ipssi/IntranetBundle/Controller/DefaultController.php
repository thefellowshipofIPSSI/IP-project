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


        if ($this->get('security.authorization_checker')->isGranted('ROLE_RH')
            || $this->get('security.authorization_checker')->isGranted('ROLE_MANAGER')
            || $this->get('security.authorization_checker')->isGranted('ROLE_SUPERVISEUR')) {

            $cras = count($this->get('intranet.repository.cra')->findAll());
            $expenses = count($this->get('intranet.repository.expense')->findAll());
            $vacations = count($this->get('intranet.repository.vacation')->findAll());
            $users = count($this->get('user.repository.user')->findAll());

            return $this->render('IntranetBundle:Default:index.html.twig', [
                'cras' => $cras,
                'expenses' => $expenses,
                'vacations' => $vacations,
                'users' => $users,
            ]);

        } else if ($this->get('security.authorization_checker')->isGranted('ROLE_COLLABORATEUR')) {

            $user_id = $this->getUser()->getId();
            $cras = count($this->get('intranet.repository.cra')->findBy(['user' => $user_id]));
            $expenses = count($this->get('intranet.repository.expense')->findBy(['user' => $user_id]));
            $vacations = count($this->get('intranet.repository.vacation')->findBy(['user' => $user_id]));
//            $users = count($this->get('user.repository.user')->findBy(['user_id' => $user_id]));

            return $this->render('IntranetBundle:Default:index.html.twig', [
                'cras' => $cras,
                'expenses' => $expenses,
                'vacations' => $vacations,
            ]);

        } else if ($this->get('security.authorization_checker')->isGranted('ROLE_REDACTEUR')) {
            $news = count($this->get('intranet.repository.news')->findAll());
            $pages = count($this->get('intranet.repository.page')->findAll());

            return $this->render('IntranetBundle:Default:index.html.twig', [
                'news' => $news,
                'pages' => $pages,
            ]);
        } else {
            return $this->render('IntranetBundle:Default:index.html.twig');
        }
    }
}