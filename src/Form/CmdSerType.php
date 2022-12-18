<?php

namespace App\Form;

use App\Entity\Commandeservice;
use Doctrine\DBAL\Types\DateImmutableType;
use FontLib\Table\Type\name;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\FormTypeInterface;

class CmdSerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('daterequis', DateType::class,[
                'format'=>'dd-MM-yyyy',
            ])
            ->add('nbjour',)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandeservice::class,
        ]);
    }
}
