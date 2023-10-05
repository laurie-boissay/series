<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Cette classe est le Repository des objets Serie.
 * Elle étend ServiceEntityRepository pour bénéficier des fonctionnalités de base de Doctrine.
 *
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Le constructeur reçoit le ManagerRegistry pour accéder à l'entité Serie.
        parent::__construct($registry, Serie::class);
    }

    /**
     * Cette fonction récupère les séries considérées comme les meilleures.
     *
     * Elle utilise QueryBuilder pour construire la requête.
     *
     * @return Serie[] Un tableau d'objets Serie représentant les meilleures séries.
     */
    public function findBestSeries()
    {
        /*
        // DQL (Doctrine Query Language) : Utilisation d'une requête DQL
        $entityManager = $this->getEntityManager(); // Récupération de l'EntityManager
        $dql = "
            SELECT s
            FROM App\Entity\Serie as s
            WHERE s.popularity > 100
            AND s.vote > 8
            ORDER BY s.popularity DESC
        ";

        $query = $entityManager->createQuery($dql); // Création de la requête à partir de la DQL
        */

        // Création d'un QueryBuilder pour construire la requête.
        $queryBuilder = $this->createQueryBuilder('s');

        // Ajout des conditions pour sélectionner les meilleures séries.
        $queryBuilder->andWhere('s.popularity > 100');
        $queryBuilder->andWhere('s.vote > 8');
        $queryBuilder->addOrderBy('s.popularity', 'DESC');

        // Création de la requête à partir du QueryBuilder.
        $query = $queryBuilder->getQuery();

        // Limite le nombre de résultats à 50.
        $query->setMaxResults(50);

        // Exécute la requête et retourne les résultats.
        $results = $query->getResult();
        dump($results); // DEBUG

        return $results;
    }
}
