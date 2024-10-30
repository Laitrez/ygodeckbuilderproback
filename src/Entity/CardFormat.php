<?php
namespace App\Entity;

use App\Repository\CardFormatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardFormatsRepository::class)]
class CardFormats
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Card::class)]
    #[ORM\JoinColumn(name: 'cardId', referencedColumnName: 'id')]
    private Card $card;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Formats::class)]
    #[ORM\JoinColumn(name: 'formatsId', referencedColumnName: 'id')]
    private Formats $format;

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): self
    {
        $this->card = $card;
        return $this;
    }

    public function getFormat(): Formats
    {
        return $this->format;
    }

    public function setFormat(Formats $format): self
    {
        $this->format = $format;
        return $this;
    }
}
