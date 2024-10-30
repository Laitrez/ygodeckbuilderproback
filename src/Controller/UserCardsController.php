<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Entity\UserCards;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserCardsController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('usercards', name: 'app_usercards', methods:['GET']) ]
    public function getUsersCards(/*SerializerInterface $serializer*/): JsonResponse
    {
        $cards = $this->entityManager->getRepository(UserCards::class)->findAll();

        return $this->json($cards);
        // return new JsonResponse($decksJson);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/DeckController.php',
        // ]);
    }

    #[Route('usercards/fav', name: 'app_usercards', methods:['GET']) ]
    public function getFavoritesUserCards(/*SerializerInterface $serializer*/): JsonResponse
    {
        $cards = $this->entityManager->getRepository(UserCards::class)->findWithFavoritesCards();

        return $this->json($cards);
        // return new JsonResponse($decksJson);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/DeckController.php',
        // ]);
    }


    #[Route('/usercards/{id}', name: 'app_usercard', methods:['GET']) ]
    public function getCard(int $id): JsonResponse
    {
        $cards = $this->entityManager->getRepository(UserCards::class)->find($id);

        return $this->json($cards);
        // return new JsonResponse($decksJson);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/DeckController.php',
        // ]);
    }


    #[Route('usercards', name: 'create_usercard', methods: ['POST'])]
    public function createCard(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // dd($data);
        assert(isset($data['user_id']),'probleme avec le konamiId');
        assert(isset($data['card_id']),  "probleme avec le nombre d'ocurrence");
        assert(isset($data['favorites']),  "probleme avec le favoris");
        assert(isset($data['occurs']),  "probleme avec le favoris");
        
        $card=$this->entityManager->getRepository(Cards::class)->findById($data['card_id']);
        $user=$this->entityManager->getRepository(Users::class)->findById($data['user_id']);
        // dd($card);
        $userCard= new UserCards();
        $userCard->setUser($user);
        $userCard->setCard($card);
        $userCard->setOccurs($data['occurs']);
        $userCard->setFavorites($data['favorites']);
        $this->entityManager->persist($userCard);
        $this->entityManager->flush();

        $location = $urlGenerator->generate('create_usercard', ['id' => $userCard->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->json($userCard, Response::HTTP_CREATED, ["Location" => $location],['groups' => ['usercards:read']]);
    }

    
    #[Route('/usercards/{id}', name: 'udpate_cards', methods: ['PUT'])]
    public function updateUserCards(int $id, Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {
        $data=json_decode($request->getContent(), true);
        $card = $this->entityManager->getRepository(UserCards::class)->find($id);
        if (!$card) {
            return new JsonResponse(['error' => 'Card not found.'], Response::HTTP_NOT_FOUND);
        }
        if (isset($data['occurs'])) {
            $card->setOccurs((int)$data['occurs']);
        }
    
        if (isset($data['favorites'])) {
            $card->setFavorites((bool)$data['favorites']);
        }
        $this->entityManager->persist($card);
        $this->entityManager->flush();
        return new JsonResponse(['status' => 'Update created'], Response::HTTP_OK);
    }



    #[Route('usercards/{id}', name: 'delete_usercards', methods: ['DELETE'])]
    public function deleteUserCards(int $id): JsonResponse
    {

        $card = $this->entityManager->getRepository(UserCards::class)->find($id);
        if (!$card) {
            return new JsonResponse(['error' => 'Card not found.'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($card);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Deck deleted successfully.'], Response::HTTP_OK);
    }
}
