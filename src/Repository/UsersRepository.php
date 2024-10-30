<?php
namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    // Méthodes personnalisées pour la classe UserRepository peuvent être ajoutées ici.

    public function findByDeleteAtNull()
    {
        return $this->createQueryBuilder('u')->andWhere('u.deleteAt is null')
            ->getQuery()->getResult();
    }


    public function findByIdArray(int $id)
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.id = :id')
        ->setParameter('id', $id)
        ->getQuery()->getResult();
    }

    public function findById(int $id)
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.id = :id')
        ->setParameter('id', $id)
        ->getQuery()->getOneOrNullResult();
    }

}
