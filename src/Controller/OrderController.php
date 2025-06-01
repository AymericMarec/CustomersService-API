<?php

namespace App\Controller;

use App\DTO\CreateOrderRequest;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\FoodRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/orders')]
class OrderController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function list(OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findAll();
        return $this->json($orders, 200, [], ['groups' => 'order_list']);
    }

    #[Route('', methods: ['POST'])]
    public function create(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        FoodRepository $foodRepository
    ): JsonResponse {
        $createOrderRequest = $serializer->deserialize(
            $request->getContent(),
            CreateOrderRequest::class,
            'json'
        );

        $order = new Order();
        $order->setTableNumber($createOrderRequest->tableNumber);

        foreach ($createOrderRequest->items as $item) {
            $food = $foodRepository->find($item->foodId);
            if (!$food) {
                return $this->json(['error' => 'Food not found'], 404);
            }

            $orderItem = new OrderItem();
            $orderItem->setFood($food);
            $orderItem->setQuantity($item->quantity);
            
            $order->addOrderItem($orderItem);
        }

        $entityManager->persist($order);
        $entityManager->flush();

        return $this->json($order, 201, [], ['groups' => 'order_list']);
    }
} 