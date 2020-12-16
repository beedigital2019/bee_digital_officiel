<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, ['attr' => ['placeholder' => 'Prenom ']])
            ->add('nom', TextType::class, ['attr' => ['placeholder' => 'Nom ']])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'Email ']])
            ->add('telephone', NumberType::class, ['attr' => ['placeholder' => 'Telephone ']])
            ->add('message', TextareaType::class, ['attr' => ['placeholder' => 'Votre message ici ... ']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
