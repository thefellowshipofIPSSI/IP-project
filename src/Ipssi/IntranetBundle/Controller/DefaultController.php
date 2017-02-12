<?php

namespace Ipssi\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Google_Client;


class DefaultController extends Controller
{
    /**
     * Intranet Homepage
     * @Route("/", name="intranet_homepage")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Erreur');
        }

//        $token = $this->getUser()->getGoogleAccessToken();
//        $userGoogleId = $this->getUser()->getGoogleId();
//        if (!isset($token) && empty($token)) {
//            throw new AccessDeniedException('Vous devez synchroniser votre compte google');
//        }
//        $client = new Google_Client();
//        $client->setApplicationName('ip-project');
//        $client->setClientId($this->getParameter('google_app_id'));
//        $client->setClientSecret($this->getParameter('google_app_secret'));
//        $client->setRedirectUri('http://www.ip-project.app/intranet');
//        $client->setAccessType('online');
//
//        $curl = curl_init('https://www.googleapis.com/gmail/v1/users/'.$userGoogleId.'/labels?alt=json&access_token='.$token);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
//        $contacts_json = curl_exec($curl);
//        curl_close($curl);
//        $results = json_decode($contacts_json, true);
//
//
//        dump($results['labels'][15]);
//        die();









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
            $candidacies = count($this->get('job.repository.candidacy')->findAll());

            return $this->render('IntranetBundle:Default:index.html.twig', [
                'cras' => $cras,
                'expenses' => $expenses,
                'vacations' => $vacations,
                'candidacies' => $candidacies,
            ]);

        } else if ($this->get('security.authorization_checker')->isGranted('ROLE_COLLABORATEUR')
            || $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

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