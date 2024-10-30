<?php

namespace App\Entity;

use App\Repository\DeckCardsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DeckCardsRepository::class)]
class DeckCards
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Decks::class)]
    #[ORM\JoinColumn(name: 'deckId', referencedColumnName: 'id')]
    // #[Groups(['deck:read'])]
    private Decks $decks;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cards::class)]
    #[ORM\JoinColumn(name: 'cardId', referencedColumnName: 'id')]
    #[Groups(['deck:read', 'card:read'])]
    private Cards $card;

    #[ORM\Column(type: 'integer')]
    #[Groups(['deck:read'])]
    private int $occurs;

    public function getDeck(): Decks
    {
        return $this->decks;
    }

    public function setDeck(Decks $decks): self
    {
        $this->decks = $decks;
        return $this;
    }
    public function removeDeck(): self
    {
        $this->decks = null;
        return $this;
    }

    // #[Groups(['deck:read'])]
    public function getCard(): Cards
    {
        return $this->card;
    }

    public function setCard(Cards $card): self
    {
        $this->card = $card;
        return $this;
    }

    public function getOccurs(): int
    {
        return $this->occurs;
    }

    public function setOccurs(int $occurs): self
    {
        $this->occurs = $occurs;
        return $this;
    }
}
