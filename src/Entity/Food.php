<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\DBAL\Types\Types;
use App\Enum\FoodType;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['food_list', 'food_detail'])]
    private ?string $picture = null;

    #[Vich\UploadableField(mapping: 'food_images', fileNameProperty: 'picture')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

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

    public function isAperitif(): bool
    {
        return $this->type === FoodType::APERITIF;
    }

    public function isStarter(): bool
    {
        return $this->type === FoodType::STARTER;
    }

    public function isDish(): bool
    {
        return $this->type === FoodType::DISH;
    }

    public function isDessert(): bool
    {
        return $this->type === FoodType::DESSERT;
    }

    public function isDrink(): bool
    {
        return $this->type === FoodType::DRINK;
    }

    public function __toString(): string
    {
        return $this->name . ' (' . $this->type->getLabel() . ')';
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;
        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
