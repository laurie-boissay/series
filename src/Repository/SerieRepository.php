<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
     * @return Paginator Un tableau d'objets Serie représentant les meilleures séries.
     */
    public function findBestSeries()
    {
        // Création d'un QueryBuilder pour construire la requête.
        $queryBuilder = $this->createQueryBuilder('s');

        // Effectue une jointure gauche entre l'entité principale "s" et l'entité "seasons"
        // et utilise l'alias "seas" pour référencer la table "seasons" dans la suite de la requête.
        $queryBuilder   ->leftJoin('s.seasons', 'seas')
                        // Ajoute également "seas" aux sélections de la requête,
                        // ce qui signifie que les colonnes de l'entité "seasons" seront incluses dans les résultats.
                        ->addSelect('seas');

        // Ajout des conditions pour sélectionner les meilleures séries.
        $queryBuilder->andWhere('s.popularity > 100');
        $queryBuilder->andWhere('s.vote > 8');
        $queryBuilder->addOrderBy('s.popularity', 'DESC');

        // Création de la requête à partir du QueryBuilder.
        $query = $queryBuilder->getQuery();

        // Limite le nombre de résultats à 50.
        $query->setMaxResults(50);

        // Création d'un objet Paginator pour paginer les résultats de la requête.
        $result = new Paginator($query);

        // Retourne le tableau paginé d'objets Serie représentant les meilleures séries.
        return $result;
    }
}
