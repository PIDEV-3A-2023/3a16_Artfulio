<?php

namespace App\Form;

use App\Entity\Artwork;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_artwork')
            ->add('description_artwork')
            ->add('prix_artwork')
            ->add('id_type', TextareaType::class)
            ->add('date')
            ->add('id_artist')
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
