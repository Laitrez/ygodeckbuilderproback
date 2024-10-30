<?php
namespace App\Entity;

use App\Repository\CardSetsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardSetsRepository::class)]
class CardSets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cardSet:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', name: 'set_name')]
    #[Groups(['cardSet:read'])]
    private string $setName;

    #[ORM\Column(type: 'integer', name: 'set_code')]
    #[Groups(['cardSet:read'])]
    private int $setCode;

    #[ORM\Column(type: 'string', name: 'set_rarity')]
    #[Groups(['cardSet:read'])]
    private string $setRarity;

    #[ORM\Column(type: 'integer', name: 'set_rarity_code')]
    #[Groups(['cardSet:read'])]
    private int $setRarity_code;

    #[ORM\Column(type: 'float', name: 'set_price')]
    #[Groups(['cardSet:read'])]
    private float $setPrice;

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

    public function getSetCode(): int
    {
        return $this->setCode;
    }

    public function setSetCode(int $setCode): self
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

    public function getSetRarityCode(): int
    {
        return $this->setRarity_code;
    }

    public function setSetRarityCode(int $setRarity_code): self
    {
        $this->setRarity_code = $setRarity_code;
        return $this;
    }

    public function getSetPrice(): float
    {
        return $this->setPrice;
    }

    public function setSetPrice(float $setPrice): self
    {
        $this->setPrice = $setPrice;
        return $this;
    }
}
