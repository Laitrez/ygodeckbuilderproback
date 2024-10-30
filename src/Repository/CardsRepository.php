<?php

namespace App\Repository;

use App\Entity\Cards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cards::class);
    }

    // Méthodes personnalisées pour la classe CardRepository peuvent être ajoutées ici.

    public function findByKonamiId(int $id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.konami_id = :id')
            ->setParameter('id', $id)
            ->getQuery()->getResult();
    }

    public function findByIdArray(int $id)
    {
        return $this->createQueryBuilder('c')
        ->andWhere('c.id = :id')
        ->setParameter('id', $id)
        ->getQuery()->getResult();
    }

    public function findById(int $id)
    {
        return $this->createQueryBuilder('c')
        ->andWhere('c.id = :id')
        ->setParameter('id', $id)
        ->getQuery()->getOneOrNullResult();
    }

}
