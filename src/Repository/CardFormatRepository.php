<?php
namespace App\Repository;

use App\Entity\CardFormats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardFormatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardFormats::class);
    }

    // Méthodes personnalisées pour la classe CardFormatsRepository peuvent être ajoutées ici.
}
