<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function list(SerieRepository $serieRepository): Response
    {
        // Récupère un tableau de séries à partir du repository de séries.
        $series = $serieRepository->findBestSeries();
        // dd($series); // DEBUG

        return $this->render('serie/list.html.twig', [
            "series" => $series
        ]);
    }

    /**
     * @Route("/details{id}", name="details")
     */
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        return $this->render('serie/detail.html.twig', [
            "serie" => $serie
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request): Response
    {
        // Crée une nouvelle instance de l'entité "Serie".
        $serie = new Serie();

        // Crée un formulaire basé sur le type "SerieType" et associe l'instance de la série.
        $serieForm = $this->createForm(SerieType::class, $serie);

        // À ce stade, le formulaire a été créé, mais il reste à le traiter.

        // TODO : Traiter le formulaire.
        // Cette ligne est un rappel pour indiquer qu'il faut ajouter la logique de traitement du formulaire ici.

        // Une fois le formulaire traité, généralement, on enregistre les données en base de données.
        // Cependant, dans le code actuel, cela n'est pas encore implémenté.

        // Enfin, on rend une vue Twig pour afficher le formulaire.
        return $this->render('serie/create.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

    /**
     * @Route("/demo", name="em-demo")
     */
    public function demo(EntityManagerInterface $entityManager): Response
    {
        // Crée une instance de l'entité Serie :
        $serie = new Serie();

        // Hydrate toutes les propriétés :
        $serie->setName('exemple');
        $serie->setBackdrop('exemple');
        $serie->setPoster('exemple');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime("- 1 year"));
        $serie->setLastAirDate(new \DateTime("- 6 month"));
        $serie->setGenres('exemple');
        $serie->setOverview('exemple');
        $serie->setPopularity(123.00);
        $serie->setVote(8.2);
        $serie->setStatus('Canceled');
        $serie->setTmdbID(329432);

        $entityManager->persist($serie); // Enregistre
        $entityManager->flush(); // Confirme + envoie la requête INSERT.
        // Les requêtes doctrine empêchent les injections SQL en BdD.

        //dump($serie); // DEBUG

        $serie->setGenres('anotherExemple'); // Update
        $entityManager->flush(); // Confirme + envoie de la requête UPDATE.

        //dump($serie); // DEBUG

        $entityManager->remove($serie); // Delete
        $entityManager->flush(); // Confirme + envoie de la requête DELETE.

        //dump($serie); // DEBUG

        return $this->render('serie/create.html.twig');
    }
}
