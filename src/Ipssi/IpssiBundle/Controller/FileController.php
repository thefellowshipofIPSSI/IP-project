<?php

namespace Ipssi\IpssiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Ipssi\IpssiBundle\Entity\File;
use UserBundle\Form\ImageType;

class FileController extends Controller
{


    /**
     * Upload a file
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(UploadedFile $uploadedFile, Request $request, Response $response = null)
    {
        $file = new File();
        $form = $this->createForm(ImageType::class, $file);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($file);
            $em->flush();


            $response = new Response();
            $response->setContent(json_encode(array('code' => 200, "success" => true)));
            return $response;

        }

        $response = new Response();
        $response->setContent(json_encode(array('code' => 500, "success" => false)));
        return $response;

    }


    /**
     * Upload a file
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAjaxAction(Request $request, Response $response = null)
    {
        $file = new File();
        $form = $this->createForm(ImageType::class, $file);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($file);
            $em->flush();


            $response = new Response();
            $response->setContent(json_encode(array('code' => 200, "success" => true)));
            return $response;

        }

        $response = new Response();
        $response->setContent(json_encode(array('code' => 500, "success" => false)));
        return $response;

    }

}
