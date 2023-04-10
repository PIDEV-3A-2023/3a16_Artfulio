<?php

namespace App\Form;
use App\Entity\Artwork;
use App\Entity\SousCat;
use App\Entity\User;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte')
            ->add('Date_post')
            
            ->add('idArtwork',EntityType::class,['class' =>Artwork::class,
            "choice_label"=>'nom_artwork'])
            ->add('id_util',EntityType::class,['class' =>User::class,
            "choice_label"=>'username'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
