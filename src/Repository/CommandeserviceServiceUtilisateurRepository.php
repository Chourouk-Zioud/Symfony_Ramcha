<?php

namespace App\Repository;

use App\Entity\CommandeserviceServiceUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandeserviceServiceUtilisateur>
 *
 * @method CommandeserviceServiceUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeserviceServiceUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeserviceServiceUtilisateur[]    findAll()
 * @method CommandeserviceServiceUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeserviceServiceUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeserviceServiceUtilisateur::class);
    }

    public function save(CommandeserviceServiceUtilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CommandeserviceServiceUtilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCmdUser($id){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandeserviceServiceUtilisateur s WHERE s.idutilisateur LIKE :id")
            ->setParameter('id',$id);
        return $query->getResult();
    }

    public function findallcmdutil(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandeserviceServiceUtilisateur s
             JOIN APP\Entity\Utilisateur c where s.idutilisateur=c.iduser order by c.nomuser ");
        return $query->getResult();
    }

    public function findallcmddescutil(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandeserviceServiceUtilisateur s
             JOIN APP\Entity\Utilisateur c where s.idutilisateur=c.iduser order by c.nomuser DESC");
        return $query->getResult();
    }

    public function findallcmddate(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandeserviceServiceUtilisateur s
             JOIN APP\Entity\Commandeservice c where s.idcommandeservice = c.idcommandeservice order by c.daterequis ");
        return $query->getResult();
    }

    public function findallcmddescdate(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandeserviceServiceUtilisateur s
             JOIN APP\Entity\Commandeservice c where s.idcommandeservice = c.idcommandeservice order by c.daterequis DESC");
        return $query->getResult();
    }

    public function nontraitee(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommandeservice) FROM APP\Entity\Commandeservice c where c.statuscommande = 'En cours de traitement' ");
        return $query->getResult();
    }

    public function encour(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommandeservice) FROM APP\Entity\Commandeservice c where c.statuscommande = 'En cours de livraison' ");
        return $query->getResult();
    }

    public function deja(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommandeservice) FROM APP\Entity\Commandeservice c where c.statuscommande = 'Deja traité' ");
        return $query->getResult();
    }

    public function aujourdhui(){
        $time = date('Y/m/d');
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommandeservice) FROM APP\Entity\Commandeservice c where c.datecommandeservice =:k ")
            ->setParameter('k',$time);
        return $query->getResult();
    }
//
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

//    public function findOneBySomeField($value): ?CommandeserviceServiceUtilisateur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
