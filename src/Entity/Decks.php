<?php
namespace App\Entity;

use App\Repository\DecksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DecksRepository::class)]
class Decks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['deck:read', 'deck:write', 'card:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    #[Groups(['deck:read', 'deck:write'])]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['deck:read'])]
    private \DateTimeInterface $creation_date;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['deck:read'])]
    private bool $is_public;

    // #[ORM\OneToMany(targetEntity: DeckCards::class, mappedBy: 'decks', fetch: 'EAGER')]
    #[ORM\OneToMany(targetEntity: DeckCards::class, mappedBy: 'decks')]
    #[Groups(['deck:read'])]
    private Collection $cards;

    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'decks')]
    private Collection $rating;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
        $this->rating = new ArrayCollection();
        $this->creation_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;
        return $this;
    }

    public function isPublic(): bool
    {
        return $this->is_public;
    }

    public function setPublic(bool $is_public): self
    {
        $this->is_public = $is_public;
        return $this;
    }

    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function getRatings(): Collection
    {
        return $this->rating;
    }

    // ---------------------------------------------------------
      /**
     * @return Collection<int, DeckCards>
     */
    // #[Groups(['deck:read'])]
    public function getDeckCards(): Collection
    {
        return $this->cards;
    }

    public function addDeckCard(DeckCards $deckCard): self
    {
        if (!$this->cards->contains($deckCard)) {
            $this->cards[] = $deckCard;
            $deckCard->setDeck($this);
        }

        return $this;
    }

    public function removeDeckCard(DeckCards $deckCard): self
    {
        if ($this->cards->removeElement($deckCard)) { 
            $deckCard->removeDeck();
        }
    
        return $this;
    }
}
