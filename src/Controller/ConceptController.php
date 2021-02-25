<?php

namespace App\Controller;

use App\Entity\Concept;
use App\Form\ConceptType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ConceptController extends AbstractController
{
    /**
     * @Route("/concept", name="concept")
     */
    public function index(): Response
    {
        $concepts = $this->getDoctrine()->getRepository(Concept::class)->findall();

        return $this->render('concept/index.html.twig', [
            'concepts' => $concepts
        ]);
    }

    /**
     * @Route("/concept/add", name="concept_add")
     */
    public function add(Request $request) 
    {
        $concept = new Concept();
        $form = $this->createForm(ConceptType::class, $concept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concept);
            $em->flush();

            $this->addFlash('success', 'La notion vient d\'être ajoutée avec succès !!');
            return $this->redirectToRoute('concept');
        }
        Return $this->render('concept/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/concept/edit/{id}", name="concept_edit", requirements={"id": "\d+"})
     */
    public function edit(Request $request, $id)
    {
        $concept = $this->getDoctrine()->getRepository(Concept::class)->find($id);
        $form = $this->createForm(ConceptType::class, $concept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $now = new DateTime();
            $concept->setUpdatedAt($now);
            $em->flush();

            $this->addFlash('success', 'La notion vient d\'être mis à jour avec succès !!');
            return $this->redirectToRoute('concept');
        }
        Return $this->render('concept/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/concept/delete/{id}", name="concept_delete", requirements={"id": "\d+"})
     */
    public function delete(Request $request, Concept $concept)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($concept);
        $em->flush();

        $this->addFlash('success', 'La notion a été supprimée avec succès !!');
        return $this->redirectToRoute('concept');
    }
}
