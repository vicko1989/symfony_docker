<?php

namespace App\Repository;

use App\Entity\Nekretnina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nekretnina>
 *
 * @method Nekretnina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nekretnina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nekretnina[]    findAll()
 * @method Nekretnina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NekretninaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nekretnina::class);
    }

    // save nekrenina data
    public function save(Nekretnina $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //delete nekretnina data
    public function remove(Nekretnina $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Nekretnina[] Returns an array of Nekretnina objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Nekretnina
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
