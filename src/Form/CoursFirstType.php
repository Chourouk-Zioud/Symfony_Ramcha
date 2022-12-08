<?php

namespace App\Form;

use App\Entity\CoursFirst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class CoursFirstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nomcours')
            ->add('categoriecours')
            ->add('sujetcours')
            ->add('niveaucours')
            ->add('imageFile', VichImageType::class, [
                'label' => ' des images uniquement',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CoursFirst::class,
        ]);
    }
}
