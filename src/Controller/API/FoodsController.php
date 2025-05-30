<?php

namespace App\Controller\API;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function get(int $id , FoodRepository $foodRepository): JsonResponse
    {
        $food = $foodRepository->find($id);
        if (!$food) {
            return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($food, Response::HTTP_OK, [], ['groups' => 'food_detail']);
    }
}