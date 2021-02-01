<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    // /**
    //  * @return Usuario[] Returns an array of Usuario objects
    //  */
    
    public function findByApellidoNombre($apellido, $nombre)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.apellido LIKE :apellido')
            ->andWhere('u.nombre LIKE :nombre')
            ->setParameter('apellido', $apellido.'%')
            ->setParameter('nombre', $nombre.'%')
            ->orderBy('u.apellido', 'ASC')
            ->orderBy('u.nombre', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByUsername($username): ?Usuario
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
