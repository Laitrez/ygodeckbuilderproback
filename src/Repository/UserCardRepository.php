<?php
namespace App\Repository;

use App\Entity\UserCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserCardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCards::class);
    }

    // Méthodes personnalisées pour la classe UserCardsRepository peuvent être ajoutées ici.
}
