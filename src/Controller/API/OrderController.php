<?php

namespace App\Controller\API;

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

#[Route('/api/orders')]
class OrderController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function list(OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findAll();
        return $this->json($orders, Response::HTTP_OK, [], ['groups' => 'order_list']);
    }

    #[Route('', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request, FoodRepository $foodRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['tableNumber']) || !is_numeric($data['tableNumber'])) {
            return new JsonResponse(['error' => 'Table number is required and must be numeric'], Response::HTTP_BAD_REQUEST);
        }

        $order = new Order();
        $order->setTableNumber(intval($data['tableNumber']));

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                if (!isset($item['foodId']) || !isset($item['quantity'])) {
                    return new JsonResponse(['error' => 'Each item must have foodId and quantity'], Response::HTTP_BAD_REQUEST);
                }

                $food = $foodRepository->find(intval($item['foodId']));
                if (!$food) {
                    return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
                }

                $quantity = intval($item['quantity']);
                if ($quantity <= 0) {
                    return new JsonResponse(['error' => 'Quantity must be greater than 0'], Response::HTTP_BAD_REQUEST);
                }

                $orderItem = new OrderItem();
                $orderItem->setFood($food);
                $orderItem->setQuantity($quantity);
                
                $order->addOrderItem($orderItem);
            }
        }

        $em->persist($order);
        $em->flush();

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

        return $this->json($order, Response::HTTP_CREATED, [], ['groups' => 'order_list']);
    }
} 