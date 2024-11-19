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

    #[ORM\Column(type: 'integer', name: 'cardmarket_price')]
    #[Groups(['cardprices:read','card:read'])]
    private int $cardmarketPrice;

    #[ORM\Column(type: 'integer', name: 'tcgplayer_price')]
    #[Groups(['cardprices:read','card:read'])]
    private int $tcgplayerPrice;

    #[ORM\Column(type: 'integer', name: 'ebay_price')]
    #[Groups(['cardprices:read','card:read'])]
    private int $ebayPrice;

    #[ORM\Column(type: 'integer', name: 'amazon_price')]
    #[Groups(['cardprices:read','card:read'])]
    private int $amazonPrice;

    #[ORM\Column(type: 'integer', name: 'coolstuffinc_price')]
    #[Groups(['cardprices:read','card:read'])]
    private int $coolstuffincPrice;

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

    public function getCardmarketPrice(): int
    {
        return $this->cardmarketPrice;
    }

    public function setCardmarketPrice(int $cardmarketPrice): self
    {
        $this->cardmarketPrice = $cardmarketPrice;
        return $this;
    }

    public function getTcgplayerPrice(): int
    {
        return $this->tcgplayerPrice;
    }

    public function setTcgplayerPrice(int $tcgplayerPrice): self
    {
        $this->tcgplayerPrice = $tcgplayerPrice;
        return $this;
    }

    public function getEbayPrice(): int
    {
        return $this->ebayPrice;
    }

    public function setEbayPrice(int $ebayPrice): self
    {
        $this->ebayPrice = $ebayPrice;
        return $this;
    }

    public function getAmazonPrice(): int
    {
        return $this->amazonPrice;
    }

    public function setAmazonPrice(int $amazonPrice): self
    {
        $this->amazonPrice = $amazonPrice;
        return $this;
    }

    public function getCoolstuffincPrice(): int
    {
        return $this->coolstuffincPrice;
    }

    public function setCoolstuffincPrice(int $coolstuffincPrice): self
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
