<?php

namespace App\Controller;

use App\Entity\Cards;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

// #[Route('/api/cards')]
class CardController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'get_cards', methods:['GET']) ]
    public function getCards(/*SerializerInterface $serializer*/): JsonResponse
    {
        $cards = $this->entityManager->getRepository(Cards::class)->findAll();

        return $this->json($cards);
        // return new JsonResponse($decksJson);
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/DeckController.php',
        // ]);
    }


    #[Route('/{id}', name: 'app_card', methods:['GET']) ]
    public function getCard(int $id): JsonResponse
    {
        $cards = $this->entityManager->getRepository(Cards::class)->find($id);

        return $this->json($cards);
    }
    #[Route('/', name: 'create_card', methods: ['POST'])]
    public function createCard(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {

        $cards = $serializer->deserialize($request->getContent(), Cards::class, 'json');
        $this->entityManager->persist($cards);
        $this->entityManager->flush();

        $location = $urlGenerator->generate('app_deck', ['id' => $cards->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->json($cards, Response::HTTP_CREATED, ["Location" => $location]);
    }

    
    #[Route('/cards/{id}', name: 'udpate_cards', methods: ['PUT'])]
    public function updateCard(Request $request, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(['status' => 'Update created'], Response::HTTP_OK);
    }

}
