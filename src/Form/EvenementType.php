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
            ->add('titre', null, [
                'label' => 'Titre de l\'événement',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Entrez le titre de l\'événement'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Concert ou spectacle' => 'Consert ou spectacle',
                    'Gala ou dinner' => 'Gala ou dinner',
                    'Formation ,cours ou atelier' => 'Formation, cours ou atelier',
                    'Jeu ou Competition' => 'Jeux ou Competition',
                    'Exposition' => 'Exposition',
                    'Séminaire' => 'Séminaire',
                    'Autre' => 'Autre',
                ],
                'label' => 'Type de collaboration',
                'required' => true,
                'placeholder' => '-- Choisissez un type --',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'événement',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Entrez une description de l\'événement'
                ],
                'constraints' => [
                    new Length([
                        'max' => 250,
                        'maxMessage' => 'La description ne doit pas dépasser {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('lieu', null, [
                'label' => 'Lieu de l\'événement',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Entrez le lieu de l\'événement'
                ]
            ])
            ->add('dateDebut', null, [
                'label' => 'Date de début de l\'événement',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('dateFin', null, [
                'label' => 'Date de fin de l\'événement',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Image pour l\'événement (fichier image uniquement)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file mb-3'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez charger une',
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
