<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\DBAL\Types\Types;
use App\Enum\FoodType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['food_list', 'food_detail'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['food_list', 'food_detail'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    #[Groups(['food_list', 'food_detail'])]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['food_list', 'food_detail'])]
    private ?string $description = null;

    #[ORM\Column(length: 50, enumType: FoodType::class)]
    #[Groups(['food_list', 'food_detail'])]
    private ?FoodType $type = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'foods')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): FoodType
    {
        return $this->type;
    }

    public function setType(FoodType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addFood($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            $order->removeFood($this);
        }

        return $this;
    }

    public function isEntree(): bool
    {
        return $this->type === FoodType::STARTER;
    }

    public function isPlat(): bool
    {
        return $this->type === FoodType::DISH;
    }

    public function isDessert(): bool
    {
        return $this->type === FoodType::DESSERT;
    }

    public function __toString(): string
    {
        return $this->name . ' (' . $this->type->getLabel() . ')';
    }
}
