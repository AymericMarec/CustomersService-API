<?php

namespace App\Controller\API;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/foods', name: 'app_foods')]
final class FoodsController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(FoodRepository $foodRepository): JsonResponse
    {
        $food = $foodRepository->findAll();
        return $this->json($food, Response::HTTP_OK, [], ['groups' => 'food_list']);
    }

    #[Route('/{id}', name: 'get', methods: ['GET'])]
    public function get(int $id, FoodRepository $foodRepository): JsonResponse
    {
        $food = $foodRepository->find($id);
        if (!$food) {
            return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($food, Response::HTTP_OK, [], ['groups' => 'food_detail']);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        
        $food = new Food();
        $food->setName($data['name'] ?? '');
        $food->setPrice($data['price'] ?? '0.00');
        $food->setDescription($data['description'] ?? '');
        $food->setType($data['type'] ?? null);
        $food->setPicture($data['picture'] ?? null);

        $entityManager->persist($food);
        $entityManager->flush();

        return $this->json($food, Response::HTTP_CREATED, [], ['groups' => 'food_detail']);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(
        int $id,
        Request $request,
        FoodRepository $foodRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $food = $foodRepository->find($id);
        if (!$food) {
            return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $food->setName($data['name']);
        }
        if (isset($data['price'])) {
            $food->setPrice($data['price']);
        }
        if (isset($data['description'])) {
            $food->setDescription($data['description']);
        }
        if (isset($data['type'])) {
            $food->setType($data['type']);
        }
        if (isset($data['picture'])) {
            $food->setPicture($data['picture']);
        }

        $entityManager->flush();

        return $this->json($food, Response::HTTP_OK, [], ['groups' => 'food_detail']);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(
        int $id,
        FoodRepository $foodRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $food = $foodRepository->find($id);
        if (!$food) {
            return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($food);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}