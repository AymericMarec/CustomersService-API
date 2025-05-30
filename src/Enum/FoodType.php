<?php

namespace App\Enum;

enum FoodType: string
{
    case STARTER = 'Starter';
    case DISH = 'Dish';
    case DESSERT = 'Dessert';

    public function getLabel(): string
    {
        return match ($this) {
            self::STARTER => 'Starter',
            self::DISH => 'Dish',
            self::DESSERT => 'Dessert',
        };
    }

    public function getOrder(): int
    {
        return match ($this) {
            self::STARTER => 1,
            self::DISH => 2,
            self::DESSERT => 3,
        };
    }
}