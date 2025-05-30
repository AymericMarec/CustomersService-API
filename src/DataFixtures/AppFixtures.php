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
        $food->setDescription('Classic pizza with tomato sauce, mozzarella cheese, and fresh basil.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caesar Salad');
        $food->setPrice('6.50');
        $food->setDescription('Crisp romaine lettuce with Caesar dressing, croutons, and parmesan cheese.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Chocolate Cake');
        $food->setPrice('4.50');
        $food->setDescription('Rich chocolate cake with a creamy chocolate frosting.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();


        $food = new Food();
        $food->setName('Spaghetti Carbonara');
        $food->setPrice('10.99');
        $food->setDescription('Classic Italian pasta dish with eggs, cheese, pancetta, and pepper.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Bruschetta');
        $food->setPrice('5.00');
        $food->setDescription('Toasted bread topped with diced tomatoes, garlic, basil, and olive oil.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Tiramisu');
        $food->setPrice('5.50');
        $food->setDescription('Classic Italian dessert made with coffee-soaked ladyfingers and mascarpone cheese.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caprese Salad');
        $food->setPrice('7.00');
        $food->setDescription('Fresh mozzarella, tomatoes, and basil drizzled with balsamic glaze.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Lasagna');
        $food->setPrice('12.99');
        $food->setDescription('Layers of pasta, meat sauce, and cheese baked to perfection.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Panna Cotta');
        $food->setPrice('4.00');
        $food->setDescription('Creamy Italian dessert made with sweetened cream thickened with gelatin.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Bruschetta al Pomodoro');
        $food->setPrice('5.50');
        $food->setDescription('Toasted bread topped with fresh tomatoes, garlic, basil, and olive oil.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Risotto alla Milanese');
        $food->setPrice('14.50');
        $food->setDescription('Creamy risotto with saffron, a classic dish from Milan.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Gelato');
        $food->setPrice('3.50');
        $food->setDescription('Italian-style ice cream available in various flavors.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Fettuccine Alfredo');
        $food->setPrice('11.99');
        $food->setDescription('Fettuccine pasta tossed in a creamy Alfredo sauce with parmesan cheese.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Antipasto Platter');
        $food->setPrice('9.50');
        $food->setDescription('A selection of cured meats, cheeses, olives, and marinated vegetables.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Pistachio Cannoli');
        $food->setPrice('4.50');
        $food->setDescription('Crispy pastry shells filled with sweet ricotta and pistachio cream.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Margherita Pizza');
        $food->setPrice('9.99');
        $food->setDescription('Classic pizza topped with fresh tomatoes, mozzarella cheese, and basil.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Caprese Skewers');
        $food->setPrice('6.00');
        $food->setDescription('Cherry tomatoes, mozzarella balls, and fresh basil drizzled with balsamic glaze.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Limoncello Tiramisu');
        $food->setPrice('5.50');
        $food->setDescription('A refreshing twist on the classic tiramisu with a hint of lemon liqueur.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Pasta Primavera');
        $food->setPrice('10.50');
        $food->setDescription('Pasta tossed with seasonal vegetables in a light olive oil sauce.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Bruschetta with Prosciutto');
        $food->setPrice('6.50');
        $food->setDescription('Toasted bread topped with fresh tomatoes, basil, and thinly sliced prosciutto.');
        $food->setType(FoodType::STARTER); // Assuming FoodType::STARTER is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Panna Cotta with Berry Compote');
        $food->setPrice('4.50');
        $food->setDescription('Creamy panna cotta served with a sweet berry compote.');
        $food->setType(FoodType::DESSERT); // Assuming FoodType::DESSERT is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName('Gnocchi al Pesto');
        $food->setPrice('12.50');
        $food->setDescription('Soft potato dumplings tossed in a fragrant basil pesto sauce.');
        $food->setType(FoodType::DISH); // Assuming FoodType::DISH is defined in your FoodType enum

        $manager->persist($food);

        $manager->flush();
    }
}
