<?php
namespace App\Entity;

use App\Repository\CardTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardTypeRepository::class)]
class CardType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $type;

    #[ORM\Column(type: 'string', name: 'human_readable_type')]
    private string $humanReadableType;

    #[ORM\Column(type: 'string', name: 'frame_type')]
    private string $frameType;

    #[ORM\OneToMany(targetEntity: Cards::class, mappedBy: 'type')]
    private Collection $card;

    public function __construct()
    {
        $this->card = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getHumanReadableType(): string
    {
        return $this->humanReadableType;
    }

    public function setHumanReadableType(string $humanReadableType): self
    {
        $this->humanReadableType = $humanReadableType;
        return $this;
    }

    public function getFrameType(): string
    {
        return $this->frameType;
    }

    public function setFrameType(string $frameType): self
    {
        $this->frameType = $frameType;
        return $this;
    }

    public function getCard(): Collection
    {
        return $this->card;
    }
}
