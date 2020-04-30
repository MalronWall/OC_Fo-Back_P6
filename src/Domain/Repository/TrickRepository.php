<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class TrickRepository extends EntityRepository implements TrickRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getTricks()
    {
        return $this->createQueryBuilder('t')

        ->orderBy('t.createdThe', 'DESC')

        ->getQuery()
        ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function getTricksFrom(int $numPage = 1, int $nbToDisplay = 10)
    {
        $from = ($numPage - 1) * $nbToDisplay;

        return $this->createQueryBuilder('t')
            ->setFirstResult($from)
            ->setMaxResults($nbToDisplay)
            ->orderBy('t.createdThe', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritdoc
     */
    public function nbEntities()
    {
        return $this->createQueryBuilder('t')
            ->select('COUNT(t)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @inheritdoc
     */
    public function getTrick($slug)
    {
        return $this->createQueryBuilder('t')
            ->where('t.slug = :slug')

            ->setParameter('slug', $slug)

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritdoc
     */
    public function verifyUniqueTitle($slug, $id = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug);

        if (!is_null($id)) {
            $qb->andWhere('t.id != :id')
                ->setParameter('id', $id);
        }

        return $qb->getQuery()
                  ->getOneOrNullResult();
    }
}
