<?php

namespace App\Form;

use App\Entity\Factureservice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureserviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('factureservicepdf')
            ->add('datefacture')
            ->add('idcommandeservice')
            ->add('iddevisservice')
            ->add('total')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Factureservice::class,
        ]);
    }
}
