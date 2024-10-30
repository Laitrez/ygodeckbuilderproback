<?php
namespace App\Repository;

use App\Entity\CardSets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardSetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardSets::class);
    }

    // Méthodes personnalisées pour la classe CardSetsRepository peuvent être ajoutées ici.
}
