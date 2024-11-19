<?php
namespace App\Entity;

use App\Repository\CardPriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CardPriceRepository::class)]
class CardPrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', name: 'cardmarket_price')]
    #[Groups(['cardprices:read','card:read'])]
    private string $cardmarketPrice;

    #[ORM\Column(type: 'string', name: 'tcgplayer_price')]
    #[Groups(['cardprices:read','card:read'])]
    private string $tcgplayerPrice;

    #[ORM\Column(type: 'string', name: 'ebay_price')]
    #[Groups(['cardprices:read','card:read'])]
    private string $ebayPrice;

    #[ORM\Column(type: 'string', name: 'amazon_price')]
    #[Groups(['cardprices:read','card:read'])]
    private string $amazonPrice;

    #[ORM\Column(type: 'string', name: 'coolstuffinc_price')]
    #[Groups(['cardprices:read','card:read'])]
    private string $coolstuffincPrice;

    #[ORM\ManyToMany(targetEntity: Cards::class, mappedBy: 'cardPrices')]
    #[Groups(['cardprices:read'])]
    private Collection $cards;
   
   
    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardmarketPrice(): string
    {
        return $this->cardmarketPrice;
    }

    public function setCardmarketPrice(string $cardmarketPrice): self
    {
        $this->cardmarketPrice = $cardmarketPrice;
        return $this;
    }

    public function getTcgplayerPrice(): string
    {
        return $this->tcgplayerPrice;
    }

    public function setTcgplayerPrice(string $tcgplayerPrice): self
    {
        $this->tcgplayerPrice = $tcgplayerPrice;
        return $this;
    }

    public function getEbayPrice(): string
    {
        return $this->ebayPrice;
    }

    public function setEbayPrice(string $ebayPrice): self
    {
        $this->ebayPrice = $ebayPrice;
        return $this;
    }

    public function getAmazonPrice(): string
    {
        return $this->amazonPrice;
    }

    public function setAmazonPrice(string $amazonPrice): self
    {
        $this->amazonPrice = $amazonPrice;
        return $this;
    }

    public function getCoolstuffincPrice(): string
    {
        return $this->coolstuffincPrice;
    }

    public function setCoolstuffincPrice(string $coolstuffincPrice): self
    {
        $this->coolstuffincPrice = $coolstuffincPrice;
        return $this;
    }
    //////////////////////////////////////////////////card
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Cards $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
            $card->addCardPrices($this);
        }

        return $this;
    }

    public function removeCard(Cards $card): self
    {
        if ($this->cards->removeElement($card)) {
            $card->removeCardPrices($this);
        }

        return $this;
    }

}
