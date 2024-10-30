<?php
namespace App\Repository;

use App\Entity\CardRace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardRaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardRace::class);
    }

    // Méthodes personnalisées pour la classe CardRaceRepository peuvent être ajoutées ici.
}
