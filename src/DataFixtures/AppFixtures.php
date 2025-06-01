<?php

namespace App\DataFixtures;

use App\Entity\Food;
use App\Enum\FoodType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $food = new Food();
        $food->setName('Pizza Margherita');
        $food->setPrice('8.99');
        $food->setDescription('Pizza classique avec sauce tomate, mozzarella et basilic frais.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/1.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caesar Salad');
        $food->setPrice('6.50');
        $food->setDescription('Laitue romaine croustillante avec sauce César, croûtons et parmesan.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/2.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Chocolate Cake');
        $food->setPrice('4.50');
        $food->setDescription('Gâteau au chocolat riche avec un glaçage crémeux au chocolat.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/3.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Spaghetti Carbonara');
        $food->setPrice('10.99');
        $food->setDescription('Plat de pâtes italien classique avec œufs, fromage, pancetta et poivre.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/4.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Bruschetta');
        $food->setPrice('5.00');
        $food->setDescription('Pain grillé garni de tomates, ail, basilic et huile d\'olive.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/5.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Tiramisu');
        $food->setPrice('5.50');
        $food->setDescription('Dessert italien classique fait de biscuits imbibés de café et de mascarpone.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/6.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caprese Salad');
        $food->setPrice('7.00');
        $food->setDescription('Mozzarella fraîche, tomates et basilic arrosés de vinaigre balsamique.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/7.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Lasagna');
        $food->setPrice('12.99');
        $food->setDescription('Couches de pâtes, sauce à la viande et fromage cuites à la perfection.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/8.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Panna Cotta');
        $food->setPrice('4.00');
        $food->setDescription('Dessert italien crémeux fait de crème sucrée épaissie à la gélatine.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/9.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Minestrone');
        $food->setPrice('6.50');
        $food->setDescription('Soupe italienne traditionnelle aux légumes de saison et pâtes.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/10.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Risotto alla Milanese');
        $food->setPrice('14.50');
        $food->setDescription('Risotto crémeux au safran, un plat classique de Milan.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/11.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Gelato');
        $food->setPrice('3.50');
        $food->setDescription('Glace à l\'italienne disponible en plusieurs parfums.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/12.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Fettuccine Alfredo');
        $food->setPrice('11.99');
        $food->setDescription('Pâtes fettuccine nappées d\'une sauce crémeuse Alfredo au parmesan.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/13.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Antipasto Platter');
        $food->setPrice('9.50');
        $food->setDescription('Sélection de charcuteries, fromages, olives et légumes marinés.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/14.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Pistachio Cannoli');
        $food->setPrice('4.50');
        $food->setDescription('Coquilles de pâte croustillantes remplies de ricotta sucrée et crème de pistache.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/15.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Pizza Quattro Formaggi');
        $food->setPrice('11.99');
        $food->setDescription('Pizza garnie de quatre fromages italiens : mozzarella, gorgonzola, parmesan et fontina.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/16.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caprese Skewers');
        $food->setPrice('6.00');
        $food->setDescription('Tomates cerises, boules de mozzarella et basilic frais arrosés de vinaigre balsamique.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/17.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Zabaglione');
        $food->setPrice('5.50');
        $food->setDescription('Mousse légère aux œufs, sucre et vin de Marsala, servie tiède avec des fruits frais.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/18.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Pasta Primavera');
        $food->setPrice('10.50');
        $food->setDescription('Pâtes aux légumes de saison dans une sauce légère à l\'huile d\'olive.');
        $food->setType(FoodType::DISH);
        $food->setPicture('/uploads/foods/19.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Carpaccio di Manzo');
        $food->setPrice('8.50');
        $food->setDescription('Fines tranches de bœuf cru marinées, servies avec roquette, parmesan et huile d\'olive.');
        $food->setType(FoodType::STARTER);
        $food->setPicture('/uploads/foods/20.webp');

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Semifreddo');
        $food->setPrice('4.50');
        $food->setDescription('Dessert glacé italien à base de crème fouettée, œufs et amaretti, servi avec une sauce au chocolat.');
        $food->setType(FoodType::DESSERT);
        $food->setPicture('/uploads/foods/21.webp');

        $manager->persist($food);

        $manager->flush();

        // Aperitifs
        $food = new Food();
        $food->setName('Shrimp Cocktail');
        $food->setPrice('8.50');
        $food->setDescription('Crevettes fraîches servies avec une sauce cocktail maison.');
        $food->setType(FoodType::APERITIF);
        $food->setPicture('/uploads/foods/22.webp');
        
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Prosciutto e Melone');
        $food->setPrice('7.50');
        $food->setDescription('Jambon de Parme finement tranché servi avec du melon frais.');
        $food->setType(FoodType::APERITIF);
        $food->setPicture('/uploads/foods/23.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Burrata con Pomodori');
        $food->setPrice('8.50');
        $food->setDescription('Burrata fraîche servie avec des tomates cerises et du basilic frais.');
        $food->setType(FoodType::APERITIF);
        $food->setPicture('/uploads/foods/24.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Calamari Fritti');
        $food->setPrice('9.00');
        $food->setDescription('Calamars frits croustillants servis avec une sauce marinara.');
        $food->setType(FoodType::APERITIF);
        $food->setPicture('/uploads/foods/25.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Olive Miste');
        $food->setPrice('5.50');
        $food->setDescription('Sélection d\'olives marines et d\'olives farcies.');
        $food->setType(FoodType::APERITIF);
        $food->setPicture('/uploads/foods/26.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        // Drinks
        $food = new Food();
        $food->setName('Prosecco');
        $food->setPrice('6.00');
        $food->setDescription('Vin mousseux italien frais et léger.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/27.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Chianti Classico');
        $food->setPrice('7.50');
        $food->setDescription('Vin rouge italien robuste de Toscane.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/28.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Pinot Grigio');
        $food->setPrice('6.50');
        $food->setDescription('Vin blanc italien sec et rafraîchissant.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/29.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Aperol Spritz');
        $food->setPrice('8.00');
        $food->setDescription('Cocktail italien classique à base d\'Aperol, prosecco et soda.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/30.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Negroni');
        $food->setPrice('9.00');
        $food->setDescription('Cocktail italien à base de gin, Campari et vermouth rouge.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/31.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Limonata');
        $food->setPrice('4.50');
        $food->setDescription('Limonade italienne fraîche faite maison.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/32.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('Espresso');
        $food->setPrice('3.00');
        $food->setDescription('Café italien fort et concentré.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/33.webp');
        
        $manager->persist($food);
        
        $manager->flush();

        $food = new Food();
        $food->setName('San Pellegrino');
        $food->setPrice('3.50');
        $food->setDescription('Eau minérale gazeuse italienne.');
        $food->setType(FoodType::DRINK);
        $food->setPicture('/uploads/foods/34.webp');
        
        $manager->persist($food);
        
        $manager->flush();
    }
}
