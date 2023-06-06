<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TrickCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trick::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['nameTrick','creationDate']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nameTrick'),
            DateTimeField::new('creationDate'),
            TextEditorField::new('description'),
            ImageField::new('mainPhoto')
                ->setUploadDir('public/' . $this->getParameter('uploads_dir'))
                ->setBasePath($this->getParameter('uploads_dir')),
            CollectionField::new('Comments'),
            CollectionField::new('PhotoTricks'),
            CollectionField::new('VideoTricks')

        ];
    }

}
