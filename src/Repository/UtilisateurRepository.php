<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Utilisateur>
 *
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function save(Utilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {

            $this->getEntityManager()->flush();
        }
    }

    public function remove(Utilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return Utilisateur[] Returns an array of Utilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Utilisateur
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function showByRoleD()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT u FROM APP\Entity\Utilisateur u WHERE u.role LIKE 'demandeur' ")
            // ->setParameter('role','demandeur')
        ;
        return $query->getResult();
    }


    public function showByRoleP()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT u FROM APP\Entity\Utilisateur u WHERE u.role LIKE 'prestateur' ")

            // ->setParameter('role','prestateur')
        ;
        return $query->getResult();
    }

    public function findByLogin($loginuser)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT DISTINCT u FROM APP\Entity\Utilisateur u WHERE u.loginuser LIKE :loginuser")
            ->setParameter('loginuser', $loginuser)
        ;
        return $query->getOneOrNullResult();
    }

    public function findByMultiple($searchValue)
    {
        return $this->createQueryBuilder('u')
            ->where('u.nomuser LIKE :nom')
            ->orWhere('u.prenomuser LIKE :prenom')
            ->setParameters(
                ['nom' => $searchValue, 'prenom'=>$searchValue,
                ])
            ->getQuery()
            ->getResult();
    }

    public function orderByName()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.nomuser', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function orderByNamedes()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.nomuser', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function NbUser(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT  count(u) FROM APP\Entity\Utilisateur u ");
        return $query->getResult();
    }

    public function NbPrest(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT  count(u) FROM APP\Entity\Utilisateur u where u.role LIKE 'prestateur' ");
        return $query->getResult();
    }

    public function NbDem(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT  count(u) FROM APP\Entity\Utilisateur u where u.role LIKE 'demandeur' ");
        return $query->getResult();
    }

    public function showByRoleB()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT u FROM APP\Entity\Utilisateur u WHERE u.role LIKE 'bloquer' ")
            // ->setParameter('role','demandeur')
        ;
        return $query->getResult();
    }

    public function NbBloc(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT  count(u) FROM APP\Entity\Utilisateur u where u.role LIKE 'bloquer' ");
        return $query->getResult();
    }

    public function findUserAdmin($nomuser){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT DISTINCT s FROM APP\Entity\Utilisateur s WHERE s.nomuser LIKE :nomuser")
            ->setParameter('nomuser',$nomuser);
        return $query->getSingleResult();
    }
}
