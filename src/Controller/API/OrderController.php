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

    #[Route('/by-type/{type}', methods: ['GET'])]
    public function getByType(string $type, OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findByType($type);
        return $this->json($orders, Response::HTTP_OK, [], ['groups' => 'order_list']);
    }

    #[Route('/by-table/{tableNumber}', methods: ['GET'])]
    public function getByTable(int $tableNumber, OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findByTableNumber($tableNumber);
        return $this->json($orders, Response::HTTP_OK, [], ['groups' => 'order_list']);
    }

    #[Route('/validate-by-type/{type}', methods: ['POST'])]
    public function validateByType(string $type, OrderRepository $orderRepository, EntityManagerInterface $em): JsonResponse
    {
        $orders = $orderRepository->findByType($type);
        
        if (empty($orders)) {
            return new JsonResponse(['message' => 'Aucune commande trouvée pour ce type'], Response::HTTP_NOT_FOUND);
        }

        foreach ($orders as $order) {
            $order->setValidated(true);
        }
        
        $em->flush();

        return $this->json([
            'message' => count($orders) . ' commande(s) validée(s)',
            'validatedOrders' => $orders
        ], Response::HTTP_OK, [], ['groups' => 'order_list']);
    }

    #[Route('/{id}/validate', methods: ['POST'])]
    public function validateOrder()
    {

    }


    #[Route('/{id}/validate', methods: ['POST'])]
    public function validate(int $id, OrderRepository $orderRepository, EntityManagerInterface $em): JsonResponse
    {
        $order = $orderRepository->find($id);
        
        if (!$order) {
            return new JsonResponse(['error' => 'Commande non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $order->setValidated(true);
        $em->flush();

        return $this->json($order, Response::HTTP_OK, [], ['groups' => 'order_list']);
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
        $order->setType($data['type'] ?? 'plats');

         $grouped = [
        'Starter' => [],
        'Dish' => [],
        'Dessert' => [],
        'Drink' => [],
        'Aperitif' => []
    ];

    $date = new \DateTime();
    $time = $date->format('H:i');
    if (isset($data['order']) && is_array($data['order'])) {
        foreach ($data['order'] as $item) {
            if (!isset($item['id']) || !isset($item['quantity'])) {
                return new JsonResponse(['error' => 'Each item must have id and quantity'], Response::HTTP_BAD_REQUEST);
            }

            $food = $foodRepository->find(intval($item['id']));
            if (!$food) {
                return new JsonResponse(['error' => 'Food not found'], Response::HTTP_NOT_FOUND);
            }

            $orderItem = new OrderItem();
            $orderItem->setFood($food);
            $orderItem->setQuantity(intval($item['quantity']));
            $order->addOrderItem($orderItem);

            $type = $food->getType()->value;
            if (isset($grouped[$type])) {
                $grouped[$type][] = [
                    'name' => $food->getName(),
                    'description' => $item['comments'] ?? '',
                    'quantity' => intval($item['quantity'])
                ];
            }
        }
    }

        $em->persist($order);
        $em->flush();

        $message = [];
        foreach (['Starter' => 'entrees', 'Dish' => 'plats', 'Dessert' => 'desserts', 'Aperitif' => 'aperitifs', 'Drink' => 'boissons'] as $type => $label) {
            if (!empty($grouped[$type])) {
                $message[] = [
                    'tableNumber' => $order->getTableNumber(),
                    'type' => $label,
                    'time' => $time,
                    'dishes' => $grouped[$type]
                ];
            }
        }

        error_log(print_r($message, true));
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