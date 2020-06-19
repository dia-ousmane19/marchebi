<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    // /**
    //  * @return Annonces[] Returns an array of Annonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /**
     * @return Annonces[] Returns an array of Annonces objects
     */

    public function FindAnnonceBySlug($slug)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.slug = :val')
            ->setParameter('val', $slug)
            // ->orderBy('a.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getSingleResult()
        ;
    }

    /**
     * @return Annonces[] Returns an array of Annonces objects
     */

    public function findAllAnnoncesByCategorie($slug): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categorie','c','WITH','c.slug = :val')
            ->Where('a.expired_at >= :date')
            ->setParameter('val', $slug)
            ->setParameter('date', new DateTime())
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * annonce expiree
     * @return Annonces[] Returns an array of Annonces objects
     */

    public function findAllAnnoncesByUserExpirer($id): array
    {
        return $this->createQueryBuilder('a')
            ->Where('a.expired_at < :date')
            ->andWhere('a.users = :val')
            ->orderBy('a.id', 'DESC')
            ->setParameter('val', $id)
            ->setParameter('date', new DateTime())
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * annonce en ligne
     * @return Annonces[] Returns an array of Annonces objects
     */

    public function findAllAnnonceEnLigne($id): array
    {
        return $this->createQueryBuilder('a')
            ->Where('a.expired_at >= :date')
            ->andWhere('a.users = :val')
            ->orderBy('a.id', 'DESC')
            ->setParameter('val', $id)
            ->setParameter('date', new DateTime())
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * toutes les annonces de lutilsateur
     *
     */

    public function TotalAnnonce($id)
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->Where('a.users = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getSingleResult()
        ;
    }
    /**
     * on chercher les annonces en fonction de ce user tape
     * @return Annonces[] Returns an array of Annonces objects
     */

    public function findAnnonceBySearch($value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.description LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->getQuery()
            ->getResult()
        ;
    }

}
