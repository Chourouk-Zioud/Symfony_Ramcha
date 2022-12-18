<?php

namespace App\Form;

use App\Entity\Commandeservice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeserviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statuscommande', ChoiceType::class, [
                'choices'  => [
                    ''=>"",
                    'En cours de traitement' => "En cours de traitement",
                    'En cours de livraison' => "En cours de livraison",
                    'Deja traité' => "Deja traité",
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandeservice::class,
        ]);
    }
}
