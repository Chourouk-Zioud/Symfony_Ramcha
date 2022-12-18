<?php

namespace App\Repository;

use App\Entity\Commandearticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commandearticle>
 *
 * @method Commandearticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commandearticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commandearticle[]    findAll()
 * @method Commandearticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandearticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandearticle::class);
    }

    public function save(Commandearticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commandearticle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllC($id){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT * FROM");

        return $query->getResult();
    }
//    /**
//     * @return Commandearticle[] Returns an array of Commandearticle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commandearticle
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
