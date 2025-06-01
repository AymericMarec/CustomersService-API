<?php

namespace App\DTO;

class CreateOrderRequest
{
    public int $tableNumber;
    
    /**
     * @var array<OrderItemRequest>
     */
    public array $items;
}

class OrderItemRequest
{
    public int $foodId;
    public int $quantity;
} 