<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descriptionService')
            ->add('dateService')
            ->add('prixService')
           // ->add('typePaiementService')
            ->add('fkIdCategorie')
            ->add('typePaiementService', ChoiceType::class, [
                'choices' => [
                    'Cash' => 'cash',
                    'Carte' => 'carte',
                ],
                'placeholder' => '', // Optional
                'required' => true, // Optional
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
            'attr' => [
                'style' => 'width: 500px; margin: 0 auto;', // Specify your custom inline style here
            ],
        ]);
    }
}
