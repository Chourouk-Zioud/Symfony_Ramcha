<?php

namespace App\Repository;

use App\Entity\Factureservice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Factureservice>
 *
 * @method Factureservice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Factureservice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Factureservice[]    findAll()
 * @method Factureservice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureserviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Factureservice::class);
    }

    public function save(Factureservice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Factureservice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findfactureser($id){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT DISTINCT s FROM APP\Entity\Factureservice s WHERE s.idcommandeservice LIKE :id")
            ->setParameter('id',$id);
        return $query->getOneOrNullResult();
    }
//    /**
//     * @return Factureservice[] Returns an array of Factureservice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Factureservice
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
