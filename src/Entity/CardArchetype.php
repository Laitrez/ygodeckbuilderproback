<?php
namespace App\Entity;

use App\Repository\CardArchetypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardArchetypeRepository::class)]
class CardArchetype
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['card:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Groups(['card:read'])]
    private string $name;

    #[ORM\OneToMany(targetEntity: Cards::class, mappedBy: 'archetype')]
    private Collection $card;

    public function __construct()
    {
        $this->card = new ArrayCollection();
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

    public function getCard(): Collection
    {
        return $this->card;
    }
}
