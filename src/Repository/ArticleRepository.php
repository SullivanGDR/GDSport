<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByMoins50(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->setParameter('prix_max', 50)
            ->andWhere('a.prix < :prix_max')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBy50a100(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.prix >= :prix_min')
            ->andWhere('a.prix <= :prix_max')
            ->setParameter('prix_min', 50)
            ->setParameter('prix_max', 100)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBy100a150(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.prix >= :prix_min')
            ->andWhere('a.prix <= :prix_max')
            ->setParameter('prix_min', 100)
            ->setParameter('prix_max', 150)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPlusDe150(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.prix >= :prix_min')
            ->setParameter('prix_min', 150)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByHomme($genre): array
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->andWhere('a.genre = :genre')
            ->setParameter('genre', $genre)
            ->getQuery()
            ->getResult()
        ;
    }
}
