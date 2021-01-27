<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ThemeController extends AbstractController
{
    /**
     * @Route("/theme", name="theme")
     */
    public function index(): Response
    {
        return $this->render('theme/index.html.twig');
    }

    /**
     * @Route("/theme/add", name="theme_add")
     */
    public function add(Request $request)
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();
        
        }

        return $this->render('theme/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
