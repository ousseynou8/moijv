<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function getGamesWithUsers()
    {
        return $this->createQueryBuilder('g') // SELECT g.* from game as g
            ->leftJoin('g.user', 'u') // LEFT JOIN user as u ON user.id = game.user_id
            ->addSelect('u') // SELECT g.*, u.*
            ->getQuery() // query(SELECT g.*, u.* FROM game as g LEFT JOIN user as u ON user.id = game.user_id)
            ->getResult(); // fecthAll()

    }

    public function searchGame($q)
    {
        return $this->createQueryBuilder('g')
            ->where('g.title LIKE :q')
            ->setParameter('q', '%'.$q.'%')
            ->getQuery()
            ->getResult();
    }

//    public function findByUser(User $user)
//    {
//        return $this->createQueryBuilder('g')
//            ->where('user = :user')
//            ->setParameter('user', $user)
//            ->getQuery()
//            ->getResult();
//    }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
