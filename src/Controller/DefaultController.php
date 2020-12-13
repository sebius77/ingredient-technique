<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @return Response
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @return Response
     * @Route("/history", name="history")
     */
    public function history(): Response
    {
        return $this->render('default/historique.html.twig');
    }


    /**
     * @return Response
     * @Route("/tools", name="tools")
     */
    public function tools(): Response
    {
        return $this->render('default/outils.html.twig');
    }

    /**
     * @return Response
     * @Route("/knowledge", name="knowledge")
     */
    public function knowledge(): Response
    {
        return $this->render('default/connaissances.html.twig');
    }
}
