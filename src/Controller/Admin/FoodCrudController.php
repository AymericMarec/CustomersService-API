<?php

namespace App\Controller\Admin;

use App\Entity\Food;
use App\Enum\FoodType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Validator\Constraints\File;

class FoodCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Food::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Plat')
            ->setEntityLabelInPlural('Plats')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm()
            ->hideOnIndex();
            
        yield TextField::new('name', 'Nom');
        
        yield MoneyField::new('price', 'Prix')
            ->setCurrency('EUR')
            ->setStoredAsCents(false);
            
        yield TextEditorField::new('description', 'Description');
            
        yield ChoiceField::new('type', 'Type')
            ->setChoices([
                'Apéritif' => FoodType::APERITIF,
                'Entrée' => FoodType::STARTER,
                'Plat' => FoodType::DISH,
                'Dessert' => FoodType::DESSERT,
                'Boisson' => FoodType::DRINK,
            ])
            ->setRequired(true);
            
        yield ImageField::new('picture', 'Image')
            ->setBasePath('')
            ->setUploadDir('public/uploads/foods')
            ->setUploadedFileNamePattern('/uploads/foods/[randomhash].webp')
            ->setRequired(false)
            ->setFormTypeOption('file_constraints', [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, PNG ou WebP)',
                ])
            ]);
    }

    public function createEntity(string $entityFqcn)
    {
        $food = new Food();
        $food->setType(FoodType::DISH); // Valeur par défaut
        return $food;
    }
}
