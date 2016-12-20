<?php

namespace ModelBundle\Repository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPaginated($maxPerPage = 5, $page=1){
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setMaxResults($maxPerPage)
            ->setFirstResult(($page-1)* $maxPerPage);

        return $qb->getQuery()->getResult();
    }

    public function getTotalNumberOfBooks(){
        $qb = $this->createQueryBuilder('b')
            ->select("COUNT(b)");
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByAuthorPaginated($authorName,$maxPerPage, $page=1){
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->join('b.author', 'a')
            ->andWhere('a.name=:authorName')
            ->setMaxResults($maxPerPage)
            ->setFirstResult(($page-1)* $maxPerPage)
            ->setParameter('authorName', $authorName);

        return $qb->getQuery()->getResult();
    }

    public function getTotalNumberOfBooksByAuthor($authorName){
        $qb = $this->createQueryBuilder('b')
            ->select("COUNT(b)")
            ->join('b.author', 'a')
            ->andWhere('a.name=:authorName')
            ->addGroupBy('a.authorName')
            ->setParameter('authorName', $authorName);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByTagPaginated($tagName,$maxPerPage, $page=1){
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->join('b.tags', 't')
            ->andWhere('t.tagName=:tagName')
            ->setMaxResults($maxPerPage)
            ->setFirstResult(($page-1)* $maxPerPage)
            ->setParameter('tagName', $tagName);

        return $qb->getQuery()->getResult();
    }

    public function getTotalNumberOfBooksByTag($tagName){
        $qb = $this->createQueryBuilder('b')
            ->select("COUNT(b)")
            ->join('b.tags', 't')
            ->andWhere('t.tagName=:tagName')
            ->addGroupBy('t.tagName')
            ->setParameter('tagName', $tagName);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getAuthorSummary(){
        $qb = $this->createQueryBuilder('b')
            ->join('b.author', 'a')
            ->select('b as details, count(b) as nb, a')
            ->groupBy('b.author');
        return $qb->getQuery()->getResult();
    }

}
