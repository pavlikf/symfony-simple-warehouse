<?php

namespace App\Controller\Admin;

use App\Entity\ProductMove;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductMoveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductMove::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            DateTimeField::new('time'),
            NumberField::new('quantity'),
            AssociationField::new('product'),
        ];
    }
}
