<?php


namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Ipssi\IntranetBundle\Entity\News;

use Ipssi\IntranetBundle\Form\NewsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;



class NewsController extends Controller
{

    /**
     * Render list of all News
     */
    public function indexAction()
    {
        $newsRepo = $this->getDoctrine()->getRepository('IntranetBundle:News');

        $allNews = $newsRepo->findBy(['status' => 1]);

        return $this->render('IpssiBundle:News:index.html.twig', [
            'allNews' => $allNews
        ]);
    }


    public function showAction($slug)
    {
        $newsRepo = $this->getDoctrine()->getRepository('IntranetBundle:News');

        $news = $newsRepo->findBySlug($slug);

        return $this->render('IpssiBundle:News:show.html.twig', [
            'news' => $news
        ]);
    }
}