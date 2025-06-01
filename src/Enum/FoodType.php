<?php

namespace App\Enum;

enum FoodType: string
{
    case APERITIF = 'Aperitif';
    case STARTER = 'Starter';
    case DISH = 'Dish';
    case DESSERT = 'Dessert';
    case DRINK = 'Drink';

    public function getLabel(): string
    {
        return match ($this) {
            self::APERITIF => 'Aperitif',
            self::STARTER => 'Starter',
            self::DISH => 'Dish',
            self::DESSERT => 'Dessert',
            self::DRINK => 'Drink',
        };
    }

    public function getOrder(): int
    {
        return match ($this) {
            self::APERITIF => 1,
            self::STARTER => 2,
            self::DISH => 3,
            self::DESSERT => 4,
            self::DRINK => 5,
        };
    }
}