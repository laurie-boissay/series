<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series", name="serie_")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(): Response
    {
        // Aller chercher les series en BdD.
        return $this->render('serie/list.html.twig', [
        ]);
    }

    /**
     * @Route("/details{id}", name="details")
     */
    public function details(int $id): Response
    {
        // Aller chercher la serie en BdD.
        return $this->render('serie/detail.html.twig', [
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {
        // Aller chercher la serie en BdD.
        return $this->render('serie/create.html.twig', [
        ]);
    }
}
