<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order_list'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Customer>
     */
    #[ORM\ManyToMany(targetEntity: Customer::class, inversedBy: 'orders')]
    #[Groups(['order_list'])]
    private Collection $ClientId;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'order', cascade: ['persist'])]
    #[Groups(['order_list'])]
    private Collection $orderItems;

    #[ORM\Column]
    #[Groups(['order_list'])]
    private ?int $tableNumber = null;

    public function __construct()
    {
        $this->ClientId = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getClientId(): Collection
    {
        return $this->ClientId;
    }

    public function addClientId(Customer $clientId): static
    {
        if (!$this->ClientId->contains($clientId)) {
            $this->ClientId->add($clientId);
        }

        return $this;
    }

    public function removeClientId(Customer $clientId): static
    {
        $this->ClientId->removeElement($clientId);

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            if ($orderItem->getOrder() === $this) {
                $orderItem->setOrder(null);
            }
        }

        return $this;
    }

    public function getTableNumber(): ?int
    {
        return $this->tableNumber;
    }

    public function setTableNumber(int $tableNumber): static
    {
        $this->tableNumber = $tableNumber;

        return $this;
    }
}
