<?php

namespace App\Controller\API;

use App\DTO\CreateOrderRequest;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\FoodRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use GuzzleHttp\Client;
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

        
        $message = [
            'tableNumber' => $data['tableNumber'] ?? null,
            'type' => $data['type'] ?? 'entrees',
            'time' => $data['time'] ?? date('H:i'),
            'dishes' => $data['dishes'] ?? []
        ];

        $client = new Client();
        try {
            $client->post('http://localhost:8765/broadcast', [
                'json' => $message
            ]);
        } catch (\Exception $e) {
            error_log('Erreur WS : ' . $e->getMessage());

        }

        return $this->json($order, 201, [], ['groups' => 'order_list']);
    }
} 