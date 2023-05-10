<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    /**
     * Returns an array of the top $limit most frequently used words in the titles of all Reclamation objects.
     *
     * @param int $limit The number of words to return
     * @return array The top $limit most frequently used words in the titles of all Reclamation objects
     */
    public function findTopWordsInTitles(int $limit = 5): array
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT r.titre FROM App\Entity\Reclamation r');
        $titles = $query->getResult();

        $words = [];
        foreach ($titles as $title) {
            $titleWords = explode(' ', $title['titre']);
            foreach ($titleWords as $word) {
                if (array_key_exists($word, $words)) {
                    $words[$word]++;
                } else {
                    $words[$word] = 1;
                }
            }
        }

        arsort($words);

        return array_slice($words, 0, $limit, true);
    }
}
