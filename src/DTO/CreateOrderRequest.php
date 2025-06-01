<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateOrderRequest
{
    #[Assert\Type('numeric')]
    #[Assert\NotBlank]
    public $TableNumber;
    
    /**
     * @var array<OrderItemRequest>
     */
    #[Assert\NotBlank]
    #[Assert\Type('array')]
    public array $items;

    public function __construct()
    {
        $this->TableNumber = intval($this->TableNumber);
    }
}

class OrderItemRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('numeric')]
    public $foodId;

    #[Assert\NotBlank]
    #[Assert\Type('numeric')]
    public $quantity;

    public function __construct()
    {
        $this->foodId = intval($this->foodId);
        $this->quantity = intval($this->quantity);
    }
} 