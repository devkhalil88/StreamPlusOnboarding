<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('subscriptionType', ChoiceType::class, [
                'choices' => ['Free' => 'free', 'Premium' => 'premium'],
                'expanded' => true, // Radio buttons
                'multiple' => false,
                'required' => true,
                'attr' => ['class' => 'form-check']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Ensures binding to User entity
        ]);
    }
}