<?php

namespace App\Controller;

use App\Entity\Sentence;
use App\Form\SentenceType;
use App\Repository\SentenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sentence")
 */
class SentenceController extends AbstractController
{
    /**
     * @Route("/", name="sentence_index", methods={"GET"})
     */
    public function index(SentenceRepository $sentenceRepository): Response
    {
        return $this->render('sentence/index.html.twig', [
            'sentences' => $sentenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sentence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sentence = new Sentence();
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sentence);
            $entityManager->flush();

            return $this->redirectToRoute('sentence_index');
        }

        return $this->render('sentence/new.html.twig', [
            'sentence' => $sentence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sentence_show", methods={"GET"})
     */
    public function show(Sentence $sentence): Response
    {
        return $this->render('sentence/show.html.twig', [
            'sentence' => $sentence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sentence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sentence $sentence): Response
    {
        $form = $this->createForm(SentenceType::class, $sentence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sentence_index');
        }

        return $this->render('sentence/edit.html.twig', [
            'sentence' => $sentence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sentence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sentence $sentence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sentence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sentence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sentence_index');
    }
}
