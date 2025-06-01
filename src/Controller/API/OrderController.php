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
    public function create(EntityManagerInterface $em, OrderRepository $orderRepository, Request $request): JsonResponse
    {
        $order = new Order();
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['tableNumber'])) {
            return new JsonResponse(['error' => 'tableNumber is required'], Response::HTTP_BAD_REQUEST);
        }

        $tableNumber = filter_var($data['tableNumber'], FILTER_VALIDATE_INT);
        if ($tableNumber === false) {
            return new JsonResponse(['error' => 'tableNumber must be an integer'], Response::HTTP_BAD_REQUEST);
        }

        $order->setTableNumber($tableNumber);
        $em->persist($order);
        $em->flush();
        
        return new JsonResponse(['message' => 'Order created successfully'], Response::HTTP_CREATED);
    }
}
