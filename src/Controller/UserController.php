<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends AbstractController
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    #[Route('/users', name: 'app_user' , methods: ['GET'])]
    public function index(): JsonResponse
    {
        // $users=$this->entityManager->getRepository(Users::class)->findAll();
        $users=$this->entityManager->getRepository(Users::class)->findAll();

        return $this->json($users, Response::HTTP_OK, [], ['groups' => ['user:read']]);
    }

    #[Route('/usersactive', name: 'get_useractive' , methods: ['GET'])]
    public function GetUsersActive(): JsonResponse
    {
        $users=$this->entityManager->getRepository(Users::class)->findByDeleteAtNull();

        return $this->json($users, Response::HTTP_OK, [], ['groups' => ['user:read']]);
    }


    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // dd($data);

        assert(isset($data['email']), 'probleme avec l email ');
        assert(isset($data['password']), 'probleme avec le password ');
        assert(isset( $data['name']), 'probleme avec le nom ');
        if (!isset($data['email'], $data['password'], $data['name'])) {
            return new JsonResponse(['error' => 'Missing required fields.'], Response::HTTP_BAD_REQUEST);
        }

        $user = new Users();
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $passwordHash = $passwordHasher->hashPassword($user, $data['password']);            
        $user->setPassword($passwordHash);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $location = $urlGenerator->generate('create_user', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->json($user, Response::HTTP_CREATED, ["Location" => $location], ['groups' => 'user:read']);
    }

    #[Route('users/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $id): JsonResponse
    {

        $user = $this->entityManager->getRepository(Users::class)->find($id);
        if (!$user) {
            return new JsonResponse(['error' => 'User not found.'], Response::HTTP_NOT_FOUND);
        }
       

        $user->setDeleteAt();
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'Deck deleted successfully.'], Response::HTTP_OK);
    }


    #[Route('/decks/{id}', name: 'udpate_deck', methods: ['PUT'])]
    public function updateDeck(Request $request, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        return new JsonResponse(['status' => 'Update created'], Response::HTTP_OK);
    }



}

