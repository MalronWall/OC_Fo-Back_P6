<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository implements CommentRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getComments($trick)
    {
        return $this->createQueryBuilder('c')

            ->where('c.trick = :trick')
            ->setParameter('trick', $trick)

            ->orderBy('c.createdThe', 'DESC')

            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function getCommentsFrom($slug, int $numPage = 1, int $nbToDisplay = 10)
    {
        $from = ($numPage - 1) * $nbToDisplay;

        $result = $this->createQueryBuilder('c')

            ->join('c.trick', 't')

            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)

            ->setFirstResult($from)
            ->setMaxResults($nbToDisplay)

            ->orderBy('c.createdThe', 'DESC')

            ->getQuery()
            ->getResult();

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function nbEntities($slug)
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->join('c.trick', 't')

            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)

            ->getQuery()
            ->getSingleScalarResult();
    }
}
