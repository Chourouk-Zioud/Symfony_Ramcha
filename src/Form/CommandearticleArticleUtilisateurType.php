<?php

namespace App\Form;

use App\Entity\CommandearticleArticleUtilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandearticleArticleUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idutilisateur')
            ->add('idarticle')
            ->add('idcommande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommandearticleArticleUtilisateur::class,
        ]);
    }
}
