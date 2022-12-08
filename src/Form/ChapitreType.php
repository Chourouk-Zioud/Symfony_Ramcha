<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Cours;
use App\Entity\CoursFirst;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ChapitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomchapitre')
            ->add('languechapitre')
            ->add('typechapitre')
            ->add('idfirst', EntityType::class,[
                'class'=>CoursFirst::class,
                'mapped'=> true,
                'choice_label'=>"nomcours",
                'multiple'=>false,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => '  des images uniquement',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
        ]);
    }
}
