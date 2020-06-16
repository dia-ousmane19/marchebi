<?php

namespace App\Repository;

use App\Entity\Images;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Images|null find($id, $lockMode = null, $lockVersion = null)
 * @method Images|null findOneBy(array $criteria, array $orderBy = null)
 * @method Images[]    findAll()
 * @method Images[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Images::class);
    }

    /**
     * @return Images[] Returns an array of Images objects
     */

    public function findByImage($idAnnonce): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.annonces = :val')
            ->setParameter('val', $idAnnonce)
            // ->orderBy('i.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    /**

     * on recupere les images principale
     * @return Images[] Returns an array of Images objects
     */

    public function findByImagePrincipale($IDAnnonce): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.annonces = :val')
            ->setParameter('val', $IDAnnonce)
            // ->orderBy('i.id', 'ASC')
             ->setMaxResults(1)
          //  ->setFirstResult(1)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Images
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
