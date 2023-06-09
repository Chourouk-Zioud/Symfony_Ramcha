<?php

namespace App\Form;

use App\Entity\Commandearticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CmdArtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('modelivraison' , ChoiceType::class, [
        'choices'  => [
            ''=>"",
            'A domicile' => "A domicile",
            'Confirmation par télephone' => "Confirmation par télephone",
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
