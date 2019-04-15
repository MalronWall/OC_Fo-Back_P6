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
     * @param $trick
     * @return mixed
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
}
