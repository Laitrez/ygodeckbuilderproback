<?php
namespace App\Entity;

use App\Repository\FormatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FormatsRepository::class)]
class Formats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['formats:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Groups(['formats:read','card:read'])]
    private string $name;

    // #[ORM\OneToMany(targetEntity: CardFormats::class, mappedBy: 'format')]
    // private Collection $cardFormats;

    #[ORM\ManyToMany(targetEntity: Cards::class, mappedBy: 'formats')]
    #[Groups(['formats:read'])]
    private Collection $cards;

    public function __construct()
    {
        // $this->cardFormats = new ArrayCollection();
        $this->cards = new ArrayCollection();
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

    // public function getCardFormats(): Collection
    // {
    //     return $this->cardFormats;
    // }
    ////////////////////////////////////////////cards
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Cards $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
            $card->addFormats($this);
        }

        return $this;
    }

    public function removeCard(Cards $card): self
    {
        if ($this->cards->removeElement($card)) {
            $card->removeFormats($this);
        }

        return $this;
    }
}
