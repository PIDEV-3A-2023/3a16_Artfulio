<?php

namespace App\Form;

use App\Entity\Parrainage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParrainageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parrainage::class,
            'attr' => [
                'style' => 'width: 500px; margin: 0 auto;', // Specify your custom inline style here
            ],
        ]);
    }
}
