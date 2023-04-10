<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = [
            'Concert' => 'Consert ou spectacle',
            'Gala' => 'Gala ou dinner',
            'Formation' => 'Formation, cours ou atelier',
            'Jeu' => 'Jeux ou Competition',
            'Expostion' => 'Expostion',
            'Seminaire' => 'Seminaire',
            'Autre' => 'Autre',
        ];
        $builder
            ->add('titre')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Concert ou spectacle' => 'Consert ou spectacle',
                    'Gala ou dinner' => 'Gala ou dinner',
                    'Formation ,cours ou atelier' => 'Formation, cours ou atelier',
                    'Jeu ou Competition' => 'Jeux ou Competition',
                    'Expostion' => 'Expostion',
                    'Seminaire' => 'Seminaire',
                    'Autre' => 'Autre',
                ],
                'label' => 'type de collaboration :',
                'required' => true,
                'placeholder' => '-- Choisissez un type --',
                'attr' => [
                    'class' => 'selectType'
                ],

            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new Length([
                        'max' => 250,
                        'maxMessage' => 'La description ne doit pas dépasser {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('lieu')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('image', FileType::class, [
                'label' => 'image pour levenement (fichier image uniquement)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'svp chargez une photo',
                    ])
                ],
            ])
            ->add('heureDebut')
            ->add('heureFin');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
