<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre nom',
                ]),
            ],
        ]) 
       
        ->add('password_user', PasswordType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre mot de passe',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                ]),
            ],
        ])
        ->add('email_user', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre adresse email',
                ]),
                new Email([
                    'message' => 'L\'adresse email "{{ value }}" est invalide.',
                    // vous pouvez ajouter plus de contraintes ici si nécessaire
                ]),
            ],
        ])
        ->add('cin_user', TextType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre numéro CIN',
                ]),
                new Length([
                    'min' => 8,
                    'max' => 8,
                    'exactMessage' => 'Le numéro CIN doit contenir exactement {{ limit }} chiffres',
                    // vous pouvez ajouter plus de contraintes ici si nécessaire
                ]),
            ],
        ])
        ->add('adresse_user', TextType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre adresse',
                ]),
                new Length([
                    'min' => 20,
                    'max' => 20,
                    'exactMessage' => 'votre adresse doit contenir exactement {{ limit }} lettres',
                ]),
            ],
        ])
        ->add('is_pro',ChoiceType::class,[ 
                'choices' => [
                    ' ' => 'pro',
                    'Oui' => 'pro_yes',
                    'Non' => 'pro_no',
                    ]
            ])
             ->add('img_user', FileType::class, [
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF).',
                        ])
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
