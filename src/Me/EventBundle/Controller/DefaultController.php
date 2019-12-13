<?php

namespace Me\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /** 
     * @Route("/hello/{name}", name="homepage")
    */
    public function indexAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');
        $events = $repo->findAll();
       // var_dump($events);
        //exit;
        return $this->render('EventBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/another-page", name="another")
    */
    public function anotherAction()
    {
        return $this->render('EventBundle:Default:another.html.twig');
    }
}
