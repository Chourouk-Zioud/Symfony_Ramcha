<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomuser')
            ->add('prenomuser')
            ->add('adressuser')
            ->add('cinuser')
            ->add('numuser')
            ->add('ddnuser', DateType::class, [
                'years' => range(1960,2022),
                'format' => 'dd-MM-yyyy',

            ])
            ->add('codepostaluser')
            ->add('loginuser')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
