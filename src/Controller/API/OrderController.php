<?php

namespace App\Controller\API;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use GuzzleHttp\Client;


#[Route('/api/order', name: 'app_order')]
final class OrderController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findAll();
        return $this->json($orders, Response::HTTP_OK, [], ['groups' => 'order_list']);
    }

    #[Route('/{id}', name: 'get', methods: ['GET'])]
    public function get(int $id, OrderRepository $orderRepository): JsonResponse
    {
        $order = $orderRepository->find($id);
        if (!$order) {
            return new JsonResponse(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($order, Response::HTTP_OK, [], ['groups' => 'order_detail']);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request): JsonResponse {
    $data = json_decode($request->getContent(), true);

    $order = new Order();
    $order->setTableNumber($data['tableNumber'] ?? null);
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

    return new JsonResponse(['message' => 'Order created successfully'], Response::HTTP_CREATED);
    }
}
