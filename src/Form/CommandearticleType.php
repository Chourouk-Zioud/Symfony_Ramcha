<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Commandearticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandearticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statuslivraison', ChoiceType::class, [
                'choices'  => [
                    ''=>"",
                    'En cours de traitement' => "En cours de traitement",
                    'En cours de livraison' => "En cours de livraison",
                    'Deja traité' => "Deja traité",
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandearticle::class,
        ]);
    }



}
