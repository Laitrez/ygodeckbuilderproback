<?php
namespace App\Entity;

use App\Repository\UserCardsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserCardsRepository::class)]
class UserCards
{   

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[Groups(['usercards:read'])]
    private Users $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cards::class)]
    #[ORM\JoinColumn(name: 'cardId', referencedColumnName: 'id')]
    #[Groups(['usercards:read'])]
    private Cards $card;

    #[ORM\Column(type: 'integer')]
    #[Groups(['usercards:read'])]
    private int $occurs;

    #[ORM\Column]
    #[Groups(['usercards:read'])]
    private ?bool $favorites = null;


    public function getId(): string
    {
        return sprintf('%d-%d', $this->user->getId(), $this->card->getId());
    }

    public function getUser(): Users
    {
        return $this->user;
    }

    public function setUser(Users $user): self
    {
        $this->user = $user;
        return $this;
    }

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
    public function getFavorites(): ?bool
    {
        return $this->favorites;
    }

    public function setFavorites(bool $favorites): static
    {
        $this->favorites = $favorites;

        return $this;
    }
}
