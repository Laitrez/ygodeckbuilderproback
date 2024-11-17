<?php
namespace App\Entity;

use App\Repository\CardRepository;
use App\Repository\CardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['card:read','usercards:read', 'deck:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Groups(['card:read','usercards:read', 'deck:read'])]
    private string $name;

    #[ORM\Column(type: 'string')]
    #[Groups(['card:read'])]
    private string $desc;

    #[ORM\Column(type: 'string')]
    #[Groups(['card:read'])]
    private string $name_en;

    #[ORM\Column(type: 'string', name: 'ygoprodecUrl')]
    #[Groups(['card:read'])]
    private string $ygoprodeck_url;

    #[ORM\Column(type: 'integer', name: 'betaId')]
    #[Groups(['card:read'])]
    private int $beta_id;

    #[ORM\Column(type: 'integer', name: 'konamiId')]
    #[Groups(['card:read','usercards:read'])]
    private int $konami_id;

    #[ORM\Column(type: 'string', name: 'mdRarity')]
    #[Groups(['card:read','usercards:read'])]
    private string $md_rarity;

    #[ORM\OneToMany(targetEntity: DeckCards::class, mappedBy: 'card')]
    // #[Groups(['card:read'])]
    private Collection $deck_cards;

    #[ORM\ManyToOne(targetEntity: CardType::class)]
    #[ORM\JoinColumn(name: 'cardTypeId', referencedColumnName: 'id')]
    #[Groups(['card:read'])]
    private CardType $type;

    #[ORM\ManyToOne(targetEntity: CardRace::class)]
    #[ORM\JoinColumn(name: 'cardRaceId', referencedColumnName: 'id')]
    #[Groups(['card:read'])]
    private CardRace $race;

    #[ORM\ManyToOne(targetEntity: CardArchetype::class)]
    #[ORM\JoinColumn(name: 'cardArchetypeId', referencedColumnName: 'id')]
    #[Groups(['card:read'])]
    private CardArchetype $archetype;

    #[ORM\OneToMany(targetEntity: UserCards::class, mappedBy: 'card')]
    // #[Groups(['card:read'])]
    private Collection $userCards;

    public function __construct()
    {
        $this->deck_cards = new ArrayCollection();
        $this->userCards = new ArrayCollection();
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

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): self
    {
        $this->desc = $desc;
        return $this;
    }

    public function getNameEn(): string
    {
        return $this->name_en;
    }

    public function setNameEn(string $name_en): self
    {
        $this->name_en = $name_en;
        return $this;
    }

    public function getYgoprodeckUrl(): string
    {
        return $this->ygoprodeck_url;
    }

    public function setYgoprodeckUrl(string $ygoprodeck_url): self
    {
        $this->ygoprodeck_url = $ygoprodeck_url;
        return $this;
    }

    public function getBetaId(): int
    {
        return $this->beta_id;
    }

    public function setBetaId(int $beta_id): self
    {
        $this->beta_id = $beta_id;
        return $this;
    }

    public function getKonamiId(): int
    {
        return $this->konami_id;
    }

    public function setKonamiId(int $konami_id): self
    {
        $this->konami_id = $konami_id;
        return $this;
    }

    public function getMdRarity(): string
    {
        return $this->md_rarity;
    }

    public function setMdRarity(string $md_rarity): self
    {
        $this->md_rarity = $md_rarity;
        return $this;
    }

    public function getDeckCards(): Collection
    {
        return $this->deck_cards;
    }

    public function getType(): CardType
    {
        return $this->type;
    }

    public function setType(CardType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getRace(): CardRace
    {
        return $this->race;
    }

    public function setRace(CardRace $race): self
    {
        $this->race = $race;
        return $this;
    }

    public function getArchetype(): CardArchetype
    {
        return $this->archetype;
    }

    public function setArchetype(CardArchetype $archetype): self
    {
        $this->archetype = $archetype;
        return $this;
    }

    public function getUserCards(): Collection
    {
        return $this->userCards;
    }
}