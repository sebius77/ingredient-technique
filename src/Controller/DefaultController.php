<?php

namespace App\Controller;

use App\Entity\Concept;
use App\Entity\Sentence;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        // Récupération de la dernière notion (concept) ajoutée
        $concept = $this->getDoctrine()->getRepository(Concept::class)->last();

        // Récupération des phrases du jour
        $sentences = $this->getDoctrine()->getRepository(Sentence::class)->findAll(); 

        // On génère un tableau de phrase avec pour index leur id
        $tabSentences = [];
        foreach ($sentences as $sentence)
        {
            $tabSentences[$sentence->getId()] = $sentence;
        }

        // On récupère au hazard une phrase
        $random = array_rand($tabSentences, 1);

        return $this->render('default/index.html.twig', [
            'concept' =>  $concept,
            'sentence' => $tabSentences[$random]
        ]);
    }

    /**
     * @Route("/concept/show/{id}", name="concept_show", requirements={"id": "\d+"})
     */
    public function show(Request $request, $id)
    {
        $concept = $this->getDoctrine()->getRepository(Concept::class)->find($id);

        if (is_null ($concept)) {
            throw $this->createNotFoundException('La notion recherchée n\'existe pas !!!');
        }

        if ($concept->getIsDraft() === true) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('default/show.html.twig', [
            'concept' => $concept
        ]);
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
