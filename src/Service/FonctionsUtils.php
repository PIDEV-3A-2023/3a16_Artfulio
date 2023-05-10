<?php

namespace App\Service;

class FonctionsUtils
{
    public static function comptageColParType($collaborations)
    {
        // initialiser un tableau associatif pour stocker le nombre de chaque type
        $nombreParType = array(
            'Egerie' => 0,
            'Financier' => 0,
            'Production video' => 0,
            'Featuring musicale' => 0,
            "Realisation d'Artwork" => 0,
            'Autre' => 0
        );

        // parcourir le tableau de collaborations et incrémenter le nombre pour chaque type
        foreach ($collaborations as $collaboration) {
            $type = strtolower($collaboration->getTypeCollaboration());
            switch ($type) {
                case 'egerie':
                    $nombreParType['Egerie']++;
                    break;
                case 'financier':
                    $nombreParType['Financier']++;
                    break;
                case 'production video':
                    $nombreParType['Production video']++;
                    break;
                case 'featuring musicale':
                    $nombreParType['Featuring musicale']++;
                    break;
                case 'realisation d\'Artwork':
                    $nombreParType['Realisation d\'Artwork']++;
                    break;
                case 'autre':
                    $nombreParType['Autre']++;
                    break;
                default:
                    break;
            }
        }

        return  $nombreParType;
    }
}
