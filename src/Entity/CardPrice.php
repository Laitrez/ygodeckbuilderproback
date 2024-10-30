<?php
namespace App\Entity;

use App\Repository\CardPriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardPriceRepository::class)]
class CardPrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', name: 'cardmarket_price')]
    private int $cardmarketPrice;

    #[ORM\Column(type: 'integer', name: 'tcgplayer_price')]
    private int $tcgplayerPrice;

    #[ORM\Column(type: 'integer', name: 'ebay_price')]
    private int $ebayPrice;

    #[ORM\Column(type: 'integer', name: 'amazon_price')]
    private int $amazonPrice;

    #[ORM\Column(type: 'integer', name: 'coolstuffinc_price')]
    private int $coolstuffincPrice;

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
}
