<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\DeckCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Decks;
use App\Entity\Rating;
use App\Form\DeckType; // Si tu crées un formulaire pour le Deck
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

// #[Route('/api/decks')]
class DeckController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/decks', name: 'get_decks', methods: ['GET'])]
    public function index(/*SerializerInterface $serializer*/): JsonResponse
    {
        // Ca c'est bon
        $deckQb = $this->entityManager->getRepository(Decks::class)->findWithCards();

        return $this->json($deckQb, Response::HTTP_OK, [], ['groups' => ['deck:read']]);
    }
    #[Route('/decks/public', name: 'get_public_decks', methods: ['GET'])]
    public function getPublicDeck(/*SerializerInterface $serializer*/): JsonResponse
    {


        $deckQb = $this->entityManager->getRepository(Decks::class)->findWithCardsPublic();
        // dd($deckQb);

        return $this->json($deckQb, Response::HTTP_OK, [], ['groups' => ['deck:read']]);
    }


    #[Route('/decks/{id}', name: 'get_deck', methods: ['GET'])]
    public function getDeck(int $id): JsonResponse
    {
        $decks = $this->entityManager->getRepository(Decks::class)->find($id);

        return $this->json($decks, Response::HTTP_OK, [], ['groups' => 'deck:read']);
    }

    #[Route('decks', name: 'create_deck', methods: ['POST'])]
    public function createDeck(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {

        // $decks = $serializer->deserialize($request->getContent(), Decks::class, 'json');
        //------------------------------------------------------------------------------------------- 
        // Récupérer les données JSON du body de la requête
        $data = json_decode($request->getContent(), true);

        // Valider les données requises
        if (!isset($data['name'])) {
            return new JsonResponse(['error' => 'Le nom du deck est requis.'], Response::HTTP_BAD_REQUEST);
        }

        // Créer une nouvelle instance de Decks
        $deck = new Decks();
        $deck->setName($data['name']);
        assert(isset($data['is_public']), 'probleme avec la visibilité du deck ');
        $deck->setPublic($data['is_public']);

        // Récupérer les cartes s'il y en a et les associer au deck
        if (isset($data['cards']) && is_array($data['cards'])) {
            foreach ($data['cards'] as $cardData) {
                assert(isset($cardData['card_id']), 'probleme avec le id de la carte ');
                assert(isset($cardData['occurs']), 'probleme avec le nombre de cartes ');
                if (isset($cardData['card_id']) && isset($cardData['occurs'])) {
                    // $konamiId = $cardData['konamiId'];
                    $occurs = $cardData['occurs'];

                    // Vérifier si une carte avec ce Konami ID existe déjà
                    $card = $this->entityManager->getRepository(Card::class)->findOneBy(['id' => $cardData['card_id']]);
                    $Dcard = new DeckCards();
                    $Dcard->setCard($card);
                    $Dcard->setDeck($deck);
                    $Dcard->setOccurs($occurs);
                    $deck->addDeckCard($Dcard);
                    $this->entityManager->persist($Dcard);
                }
            }
        }

        // Sauvegarder le deck en base de données
        $this->entityManager->persist($deck);
        $this->entityManager->flush();

        $location = $urlGenerator->generate('create_deck', ['id' => $deck->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        // dd($deck);

        return $this->json($deck, Response::HTTP_CREATED, ["Location" => $location], ['groups' => 'deck:read']);
    }




    #[Route('decks/{id}', name: 'delete_deck', methods: ['DELETE'])]
    public function deleteDeck(int $id): JsonResponse
    {

        $deck = $this->entityManager->getRepository(Decks::class)->find($id);
        if (!$deck) {
            return new JsonResponse(['error' => 'Deck not found.'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($deck);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Deck deleted successfully.'], Response::HTTP_OK);
    }


    #[Route('/decks/{id}', name: 'udpate_deck', methods: ['PUT'])]
    public function updateDeck(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(['status' => 'Update created'], Response::HTTP_OK);
    }



    // methode lié a la notation du deck 

    #[Route('/decks/{id}/rate', name: 'rating_deck', methods: ['POST'])]
    public function rateDeck(int $id, Request $request): JsonResponse
    {
        // $user = $this->getUser();
        $deck = $this->entityManager->getRepository(Decks::class)->find($id);

        if (!$deck) {
            return new JsonResponse(['error' => 'Deck not found'], Response::HTTP_NOT_FOUND);
        }


        $rating = new Rating();
        // $rating->setUser($user);
        $rating->setDeck($deck);
        // $rating->setUser($deck);
        $rating->setRate();
        dd($rating);

        $this->entityManager->persist($rating);
        $this->entityManager->flush();

        return new JsonResponse(['success' => 'RATED'], Response::HTTP_OK);
    }



    #[Route('/decks/{id}/total-rating', name: 'total_rating', methods: ['GET'])]
    public function totalRating(int $id): JsonResponse
    {
        $deck = $this->entityManager->getRepository(Decks::class)->find($id);

        if (!$deck) {
            return new JsonResponse(['error' => 'Deck not found'], Response::HTTP_NOT_FOUND);
        }

        $ratings = $deck->getRate();
        $total = 0;
        $count = count($ratings);

        return new JsonResponse(['total' => $count]);
    }
}
