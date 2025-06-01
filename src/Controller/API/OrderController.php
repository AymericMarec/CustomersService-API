<?php

namespace App\Controller\API;

use App\DTO\CreateOrderRequest;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        $order->setTableNumber(intval($data['tableNumber'] ?? null));
        $em->persist($order);
        $em->flush();
        return new JsonResponse(['message' => 'Order created successfully'], Response::HTTP_CREATED);
    }
}
