<?php

namespace App\Controller\Admin;

use App\Entity\GroupTrick;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GroupTrickCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GroupTrick::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            ImageField::new('logo')
                ->setUploadDir('public/' . $this->getParameter('uploads_dir_grp'))
                ->setBasePath($this->getParameter('uploads_dir_grp')),
        ];
    }

}
