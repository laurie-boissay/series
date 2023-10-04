<?php

namespace App\Controller;

//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function create(Request $request): Response
    {
        //dump("test Dump");
        //dd("yo");
        //dd($request);
        dump($request);

        // Aller chercher la serie en BdD.
        return $this->render('serie/create.html.twig');
    }
}
