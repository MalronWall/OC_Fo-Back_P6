<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\DTO\UpdateTrickDTO;
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
            $qb->andWhere('t.id = :id')
                ->setParameter('id', $id);
        }

        return $qb->getQuery()
                  ->getOneOrNullResult();
    }
}
