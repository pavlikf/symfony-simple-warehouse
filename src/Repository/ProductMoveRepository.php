<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductMove;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductMove|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductMove|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductMove[]    findAll()
 * @method ProductMove[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductMoveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductMove::class);
    }

    public function getSumWithProduct()
    {
        $q = $this->createQueryBuilder('pm')
            ->select('SUM(pm.quantity * p.price)')
            ->join(Product::class, "p")
            ->getQuery();

        return $q->getSingleScalarResult();
    }

    public function getProductsTotalStock()
    {
        $q = $this->createQueryBuilder('pm')
            ->select('SUM(pm.quantity)')
            ->getQuery();

        return $q->getSingleScalarResult();
    }

    // /**
    //  * @return ProductMove[] Returns an array of ProductMove objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductMove
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
