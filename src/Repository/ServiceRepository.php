<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Twilio\Rest\Client;


class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function save(Service $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Service $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Service p
                WHERE p.disponibiliteservice LIKE :str
               '
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function sendsms(): void
    {
        //require ('vendor\autoload.php');
        $sid = "ACfb6bcee89f7deb403c1cf20e5e1a9e4d" ; //getenv("AC2420083fb29a62edd5f592cfa12ac98f");
        $token = "0c390aeb02964940e4fcce76771a6e62" ; //getenv("c2daf4ab58d08620521e2471488640f5");
        $client = new Client ($sid, $token);

        $message = $client->messages
            ->create("+21656522975", // to
                ["body" => "Il y a un service est ajouté consultez notre application pour plus de détaille ", "from" => "+15099023873"]
            );

    }

}
