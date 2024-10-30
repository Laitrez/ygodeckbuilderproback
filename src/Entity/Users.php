<?php
namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read','usercards:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    #[Groups(['user:read','usercards:read'])]
    private string $name;

    #[ORM\Column(type: 'string')]
    #[Groups(['user:write'])]
    private string $password;

    #[ORM\Column(type: 'string')]
    #[Groups(['user:read','usercards:read'])]
    private string $email;

    // #[ORM\Column(type: 'boolean')]
    // private bool $is_admin;

    #[ORM\OneToMany(targetEntity: UserCards::class, mappedBy: 'user')]
    #[Groups(['user:read'])]
    private Collection $userCards;

    #[ORM\OneToMany(targetEntity: Decks::class, mappedBy: 'user')]
    private Collection $decks;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['user:read'])]
    private ?\DateTimeInterface $createAt = null;
        
    #[ORM\Column(type: Types::DATE_MUTABLE ,nullable: true)]
    #[Groups(['user:read'])]
    private ?\DateTimeInterface $deleteAt = null;

    public function __construct()
    {
        $this->userCards = new ArrayCollection();
        $this->decks = new ArrayCollection();
        $this->createAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $username): self
    {
        $this->name = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // public function isAdmin(): bool
    // {
    //     return $this->is_admin;
    // }

    // public function setAdmin(bool $is_admin): self
    // {
    //     $this->is_admin = $is_admin;
    //     return $this;
    // }

    public function getUserCards(): Collection
    {
        return $this->userCards;
    }

    public function getDecks(): Collection
    {
        return $this->decks;
    }
    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $creation_date): static
    {
        $this->createAt = $creation_date;

        return $this;
    }

    public function getDeleteAt(): ?\DateTimeInterface
    {
        return $this->deleteAt;
    }

    public function setDeleteAt(): static
    {
        $this->deleteAt = new \DateTime();

        return $this;
    }
}
