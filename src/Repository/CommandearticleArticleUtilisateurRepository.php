<?php

namespace App\Repository;

use App\Entity\CommandearticleArticleUtilisateur;
use App\Entity\Utilisateur;
use App\Entity\Article;
use App\Entity\Commandearticle;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandearticleArticleUtilisateur>
 *
 * @method CommandearticleArticleUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandearticleArticleUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandearticleArticleUtilisateur[]    findAll()
 * @method CommandearticleArticleUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandearticleArticleUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandearticleArticleUtilisateur::class);
    }

    public function save(CommandearticleArticleUtilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CommandearticleArticleUtilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCmdUser($id){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandearticleArticleUtilisateur s WHERE s.idutilisateur LIKE :id")
            ->setParameter('id',$id);
        return $query->getResult();
    }

    public function findallcmdutil(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandearticleArticleUtilisateur s
             JOIN APP\Entity\Utilisateur c where s.idutilisateur = c.iduser order by c.nomuser ");
        return $query->getResult();
    }

    public function findallcmddescutil(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandearticleArticleUtilisateur s
             JOIN APP\Entity\Utilisateur c where s.idutilisateur = c.iduser order by c.nomuser DESC");
        return $query->getResult();
    }

    public function findallcmddate(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandearticleArticleUtilisateur s
             JOIN APP\Entity\Commandearticle c where s.idcommande = c.idcommande order by c.datecommande ");
        return $query->getResult();
    }

    public function findallcmddescdate(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\CommandearticleArticleUtilisateur s
             JOIN APP\Entity\Commandearticle c where s.idcommande = c.idcommande order by c.datecommande DESC");
        return $query->getResult();
    }

    public function nontraitee(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommande) FROM APP\Entity\Commandearticle c where c.statuslivraison = 'En cours de traitement' ");
        return $query->getResult();
    }

    public function encour(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommande) FROM APP\Entity\Commandearticle c where c.statuslivraison = 'En cours de livraison' ");
        return $query->getResult();
    }

    public function deja(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommande) FROM APP\Entity\Commandearticle c where c.statuslivraison = 'Deja traité' ");
        return $query->getResult();
    }

    public function aujourdhui(){
        $time = date('Y/m/d');
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT COUNT (c.idcommande) FROM APP\Entity\Commandearticle c where c.datecommande =:k ")
            ->setParameter('k',$time);
        return $query->getResult();
    }

//    /**
//     * @return CommandearticleArticleUtilisateur[] Returns an array of CommandearticleArticleUtilisateur objects
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

//    public function findOneBySomeField($value): ?CommandearticleArticleUtilisateur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
