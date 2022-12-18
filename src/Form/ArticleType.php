<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categoriearticle;
use App\Entity\Magasin;
use App\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomarticle')
            ->add('marquearticle')
            ->add('typearticle')
            ->add('disponibilitearticle')
            ->add('couleurarticle')
            ->add('prixarticle')
            ->add('taillearticle')
            ->add('categorie', EntityType::class,[
                'class' => Categoriearticle::class,
                'choice_label' => 'libelle',
            ])
            ->add('magasin', EntityType::class,[
                'class' => Magasin::class,
                'choice_label' => 'nommagasin',
            ])
            ->add('descriptionarticle')
            //->add('note')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de loffre ( des images uniquement)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
