<?php
// src/Form/TextType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType as BaseTextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
    }

    public function getParent()
    {
        return BaseTextType::class;
    }
}
