<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

class PrestateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('dispop', ChoiceType::class, [
                'choices'  => [
                    'Disponible' => "Disponible",
                    'Non disponible' => "Non disponible",
                ],])
            ->add('experp')
            ->add('diplomep')
            ->add('postep', ChoiceType::class, [
                'choices'  => [
                    'Responsable' => "Responsable",
                    'Sous-Responsable' => "Sous-Responsable",
                    'Ouvrier' => "Ouvrier",
                ],])
            ->add('salairep')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
