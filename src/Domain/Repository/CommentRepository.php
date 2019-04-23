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
    public function getCommentsFrom($trick, int $numPage = 1, int $nbToDisplay = 10)
    {
        $from = ($numPage - 1) * $nbToDisplay;

        return $this->createQueryBuilder('c')

            ->where('c.trick = :trick')
            ->setParameter('trick', $trick)

            ->setFirstResult($from)
            ->setMaxResults($nbToDisplay)

            ->orderBy('c.createdThe', 'DESC')

            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function nbEntities()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
