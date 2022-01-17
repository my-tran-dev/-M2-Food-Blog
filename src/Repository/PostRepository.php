<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Post::class);
  }

  /**
   * Redefine order
   * @return Post[]
   */
  public function findAll()
  {
    return $this->findBy(array(), array('published' => 'DESC'));
  }

  /**
   * Returns all Posts per page
   * @return void
   */
  public function getPaginatedPosts($page, $limit)
  {
    $query = $this->createQueryBuilder('p')
      ->orderBy('p.published', 'DESC')
      ->setFirstResult(($page * $limit) - $limit)
      ->setMaxResults($limit);
    return $query->getQuery()->getResult();
  }

  /**
   * Return total de posts
   * @return void
   */
  public function getTotalPosts()
  {
    $query = $this->createQueryBuilder('p')
      ->select('COUNT(p)');
    return $query->getQuery()->getSingleScalarResult();
  }

  // /**
  //  * @return Post[] Returns an array of Post objects
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
    public function findOneBySomeField($value): ?Post
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
