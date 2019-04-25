<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\MediaRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class MediaRepository extends EntityRepository implements MediaRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getMedia($id)
    {
        return $this->createQueryBuilder('m')
            ->where('m.id = :id')

            ->setParameter('id', $id)

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritdoc
     */
    public function unsetFirstDb($trick)
    {
        return $this->createQueryBuilder('m')
            ->update()
            ->set("m.first", "false")
            ->where('m.trick = :trick')

            ->setParameter('trick', $trick)

            ->getQuery()
            ->execute();
    }
}
