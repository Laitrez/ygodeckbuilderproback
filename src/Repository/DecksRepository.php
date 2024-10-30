<?php

namespace App\Repository;

use App\Entity\Decks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Decks>
 */
class DecksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Decks::class);
    }


    // Requete pour tout recup avec les cards
    // public function findWithCards()
    public function findWithCards()
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.cards', 'dc')
            ->addSelect('dc')
            ->getQuery()->getResult();
    }

    public function findWithCardsPublic()
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.is_public = true')
            ->leftJoin('d.cards', 'c')
            ->addSelect('c')
            ->getQuery()->getResult();
    }
    //    /**
    //     * @return Decks[] Returns an array of Decks objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Decks
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery() 
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
