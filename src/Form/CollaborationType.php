<?php

namespace App\Form;

use App\Entity\Collaboration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollaborationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeCollaboration', ChoiceType::class, [
                'choices' => [
                    'Egerie' => 'egerie',
                    'Financier' => 'financier',
                    'Production video' => 'Production video',
                    'Featuring musicale' => 'Featuring musicale',
                    "Realisation d'Artwork" => 'egerie',
                    'Autre' => 'Autre',
                ],
                'label' => 'type de collaboration :',
                'required' => true,
                'attr' => [
                    'class' => 'selectType'
                ]
            ])
            ->add('titre')
            ->add('description')
            ->add('dateSortie')
            ->add('status')
            ->add('nomUser')
            ->add('emailUser');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collaboration::class,
        ]);
    }
}
