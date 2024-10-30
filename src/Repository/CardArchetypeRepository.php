<?php
namespace App\Repository;

use App\Entity\CardArchetype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardArchetypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardArchetype::class);
    }

    // Méthodes personnalisées pour la classe CardArchetypeRepository peuvent être ajoutées ici.
}
