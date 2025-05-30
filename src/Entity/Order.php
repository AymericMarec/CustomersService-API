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
    private ?int $id = null;

    /**
     * @var Collection<int, Customer>
     */
    #[ORM\ManyToMany(targetEntity: Customer::class, inversedBy: 'orders')]
    #[Groups(['order_list'])]
    private Collection $ClientId;

    /**
     * @var Collection<int, Food>
     */
    #[ORM\ManyToMany(targetEntity: Food::class, inversedBy: 'orders')]
    #[Groups(['order_list'])]
    private Collection $foods;

    #[ORM\Column]
    #[Groups(['order_list'])]
    private ?int $tableNumber = null;

    public function __construct()
    {
        $this->ClientId = new ArrayCollection();
        $this->foods = new ArrayCollection();
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
     * @return Collection<int, Food>
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function addFood(Food $food): static
    {
        if (!$this->foods->contains($food)) {
            $this->foods->add($food);
        }

        return $this;
    }

    public function removeFood(Food $food): static
    {
        $this->foods->removeElement($food);

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
