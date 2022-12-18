<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cinuser')
            ->add('nomuser')
            ->add('prenomuser')
            ->add('adressuser')
            ->add('passwuser' , PasswordType::class)
            ->add('numuser')
            ->add('ddnuser', DateType::class, [
                'years' => range(1960,2022),
                'format' => 'dd-MM-yyyy',

            ])
            ->add('codepostaluser')
            ->add('loginuser')
            ->add('captcha', ReCaptchaType::class)
            ->add('imageFile', VichImageType::class, [
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
