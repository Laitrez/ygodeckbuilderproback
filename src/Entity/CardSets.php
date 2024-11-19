<?php
namespace App\Entity;

use App\Repository\CardSetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardSetsRepository::class)]
class CardSets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cardSet:read','card:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', name: 'set_name')]
    #[Groups(['cardSet:read','card:read'])]
    private string $setName;

    #[ORM\Column(type: 'string', name: 'set_code')]
    #[Groups(['cardSet:read','card:read'])]
    private string $setCode;

    #[ORM\Column(type: 'string', name: 'set_rarity')]
    #[Groups(['cardSet:read','card:read'])]
    private string $setRarity;

    #[ORM\Column(type: 'string', name: 'set_rarity_code')]
    #[Groups(['cardSet:read','card:read'])]
    private string $setRarity_code;

    #[ORM\Column(type: 'string', name: 'set_price')]
    #[Groups(['cardSet:read','card:read'])]
    private string $setPrice;

    #[ORM\ManyToMany(targetEntity: Cards::class, mappedBy: 'cardSets')]
    #[Groups(['cardSet:read'])]
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSetName(): string
    {
        return $this->setName;
    }

    public function setSetName(string $setName): self
    {
        $this->setName = $setName;
        return $this;
    }

    public function getSetCode(): string
    {
        return $this->setCode;
    }

    public function setSetCode(string $setCode): self
    {
        $this->setCode = $setCode;
        return $this;
    }

    public function getSetRarity(): string
    {
        return $this->setRarity;
    }

    public function setSetRarity(string $setRarity): self
    {
        $this->setRarity = $setRarity;
        return $this;
    }

    public function getSetRarityCode(): string
    {
        return $this->setRarity_code;
    }

    public function setSetRarityCode(string $setRarity_code): self
    {
        $this->setRarity_code = $setRarity_code;
        return $this;
    }

    public function getSetPrice(): string
    {
        return $this->setPrice;
    }

    public function setSetPrice(string $setPrice): self
    {
        $this->setPrice = $setPrice;
        return $this;
    }
    /////////////////////////////////////////////////////////
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Cards $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
            $card->addCardSets($this);
        }

        return $this;
    }

    public function removeCard(Cards $card): self
    {
        if ($this->cards->removeElement($card)) {
            $card->removeCardSets($this);
        }

        return $this;
    }

}
