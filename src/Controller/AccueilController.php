<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('accueil/accueil.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function cgu(): Response
    {
        return $this->render('accueil/cgu.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
