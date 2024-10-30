<?php
namespace App\Repository;

use App\Entity\Formats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FormatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formats::class);
    }

    // Méthodes personnalisées pour la classe FormatsRepository peuvent être ajoutées ici.
}
