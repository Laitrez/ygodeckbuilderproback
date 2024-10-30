<?php
namespace App\Repository;

use App\Entity\DeckCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeckCardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeckCards::class);
    }

    // Méthodes personnalisées pour la classe DeckCardsRepository peuvent être ajoutées ici.
}
