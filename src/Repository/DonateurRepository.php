<?php

namespace App\Repository;

use App\Entity\Donateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Donateur>
 *
 * @method Donateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donateur[]    findAll()
 * @method Donateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donateur::class);
    }

    public function add(Donateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Donateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Donateur[] Returns an array of Donateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findSommeTotal()
    {
        return $this->createQueryBuilder('d')
            ->select('SUM(d.montant)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
