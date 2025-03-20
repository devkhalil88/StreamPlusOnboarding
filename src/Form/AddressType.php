<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('addressLine1', TextType::class, ['required' => true])
            ->add('addressLine2', TextType::class, ['required' => false])
            ->add('city', TextType::class, ['required' => true])
            ->add('postalCode', TextType::class, ['required' => true])
            ->add('state', TextType::class, ['required' => true])
            ->add('country', CountryType::class, ['required' => true]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
