<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    //    /**
    //     * @return Order[] Returns an array of Order objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByType(string $type): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.type = :type')
            ->andWhere('o.validated = :validated')
            ->setParameter('type', $type)
            ->setParameter('validated', false)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByTableNumber(int $tableNumber): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.tableNumber = :tableNumber')
            ->andWhere('o.validated = :validated')
            ->setParameter('tableNumber', $tableNumber)
            ->setParameter('validated', false)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
