<?php

namespace App\Controller\Admin;

use App\Entity\Personnels;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
//use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PersonnelsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personnels::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureCrud(Crud $crud):Crud
    {
        return $crud
        ->setEntityLabelInSingular('Utilisateurs')
        ->setEntityLabelInPlural('Utilisateurs bénéficiaires')
        ->setPaginatorPageSize(15);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('Nom'),
            Field::new('Prenom'),
            Field::new('Sexe'),
            Field::new('Fonction'),
            Field::new('Telephone'),
            Field::new('Email')->setFormTypeOption('disabled', 'disabled'),
            
        ];
    }
    
}
