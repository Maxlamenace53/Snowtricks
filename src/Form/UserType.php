<?php

namespace App\Form;

use App\Entity\User;
use http\Env\Url;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class)
            //->add('roles')
            ->add('password',PasswordType::class)
            ->add('firstname')
            ->add('lastname')
            ->add('nickname')
            ->add('description',TextareaType::class)
            ->add('avatar', FileType::class, [
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'attr' => ['accept' => 'image/*']
            ])
            ->add('removeAvatar', CheckboxType::class, [
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
