<?php

namespace App\Repository;

use App\Entity\ArtisteCollaboration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtisteCollaboration>
 *
 * @method ArtisteCollaboration|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtisteCollaboration|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtisteCollaboration[]    findAll()
 * @method ArtisteCollaboration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisteCollaborationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtisteCollaboration::class);
    }

    public function save(ArtisteCollaboration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArtisteCollaboration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ArtisteCollaboration[] Returns an array of ArtisteCollaboration objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArtisteCollaboration
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
