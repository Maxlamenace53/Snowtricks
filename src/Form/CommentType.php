<?php

namespace App\Form;

use App\Entity\Comment;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment',TextareaType::class,[
                'attr'=>[
                    'classe'=>'spaceComment__content',
                    'onload'=>'clean_textarea()',
                    'placeholder'=>'Votre commentaire',
                    'label'=> false,

            ]
            ])
            ->add('captcha', CaptchaType::class,[
                'disabled' => true,
                'label' => false,
                'invalid_message' => 'Mauvais captcha',
            ])
            ->add('soumettre', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
