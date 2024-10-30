<?php
namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Decks::class)]
    #[ORM\JoinColumn(name: 'deck_id', referencedColumnName: 'id')]
    private ?Decks $decks;


    
    #[ORM\ManyToOne(inversedBy: 'rating')]
    private ?Users $user = null;


    #[ORM\Column(type: 'integer')]
    private ?int $rate=0;

    // #[ORM\Column(type: 'text')]
    // private string $comment;

    public function getDeck(): Decks
    {
        return $this->decks;
    }

    public function setDeck(Decks $decks): self
    {
        $this->decks = $decks;
        return $this;
    }
    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(): self
    {
        $this->rate +=1;
        return $this;
    }

    // public function getComment(): string
    // {
    //     return $this->comment;
    // }

    // public function setComment(string $comment): self
    // {
    //     $this->comment = $comment;
    //     return $this;
    // }
}
