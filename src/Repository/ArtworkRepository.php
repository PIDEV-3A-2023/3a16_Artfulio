<?php

namespace App\Repository;

use App\Entity\Artwork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artwork>
 *
 * @method Artwork|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artwork|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artwork[]    findAll()
 * @method Artwork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtworkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artwork::class);
    }

    public function save(Artwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Artwork[] Returns an array of Artwork objects
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

//    public function findOneBySomeField($value): ?Artwork
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function findart($value): ?Artwork
   {
    return $this->createQueryBuilder('u')
               ->andWhere('u.id_artwork = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
   }
public function findonly5(): array
   {
       return $this->createQueryBuilder('a')
          
           ->orderBy('a.likes_count', 'Desc')
           ->setMaxResults(5)
           ->getQuery()
           ->getResult()
       ;
   }
public function findByname($value): array
   {
       return $this->createQueryBuilder('a')
           ->Where('a.nom_artwork like :val')
           ->setParameter('val', '%'.$value.'%')
           ->getQuery()
           ->getResult()
       ;
   }
   public function findBytypevideo(): array
   {
       return $this->createQueryBuilder('a')
           ->Where('a.id_type  = 3')
           ->orderBy('a.date', 'asc')
           ->getQuery()
           ->getResult()
       ;
   }
   public function findBytypemusic(): array
   {
       return $this->createQueryBuilder('a')
       
           ->Where('a.id_type  = 4')
           ->orderBy('a.date', 'asc')
           ->getQuery()
           ->getResult()
       ;
   } public function findBytypeimage(): array
   {
       return $this->createQueryBuilder('a')
           ->Where('a.id_type  = 2')
           ->orderBy('a.date', 'asc')
           ->getQuery()
           ->getResult()
       ;
   }
   public function orderbyname(){
  
    return $this->createQueryBuilder('a')
               ->orderBy('a.nom_artwork', 'asc')
               ->getQuery()
               ->getResult()
           ;
   }
   public function orderbyprice(){
  
    return $this->createQueryBuilder('a')
               ->orderBy('a.prix_artwork', 'asc')
               ->getQuery()
               ->getResult()
           ;
   }
   public function orderbydate(){
  
    return $this->createQueryBuilder('a')
               ->orderBy('a.date', 'asc')
               ->getQuery()
               ->getResult()
           ;
   }
   
}
