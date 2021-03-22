<?php

namespace App\Controller;

use App\Entity\Concept;
use App\Entity\Parameters;
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
        $parameters = null;
        $parameter_name = $_ENV['PARAMETER'];
        if (!is_null($parameter_name)) {
            $parameters = $this->getDoctrine()->getRepository(Parameters::class)->findOneBy([
                'name' => $parameter_name
            ]);
        }

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
            'sentence' => $tabSentences[$random],
            'parameters' => $parameters
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
     * @Route("/references", name="references")
     */
    public function references()
    {
        $references = null;
        $parameter_name = $_ENV['PARAMETER'];
        $parameters = $this->getDoctrine()->getRepository(Parameters::class)->findOneBy([
            'name' => $parameter_name
        ]);

        if (!is_null($parameters)) {
            $references = $parameters->getReferences();
        }
        
        return $this->render('default/references.html.twig', [
            'references' => $references
        ]);

    }
}
