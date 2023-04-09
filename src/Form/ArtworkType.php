<?php

namespace App\Form;

use App\Entity\Artwork;
use App\Entity\SousCat;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ArtworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_artwork')
            ->add('description_artwork')
            ->add('prix_artwork')
            ->add('id_artist',EntityType::class,['class' =>User::class,
            "choice_label"=>'username'])
            
            ->add('date')
            ->add('id_type',EntityType::class,['class' =>SousCat::class,
            "choice_label"=>'type_sous_cat'])
            ->add('lien_artwork')
            ->add('dimension_artwork')
            ->add('img_artwork')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artwork::class,
        ]);
    }
}
