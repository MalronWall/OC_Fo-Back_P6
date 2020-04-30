<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\TypeMediaRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class TypeMediaRepository extends EntityRepository implements TypeMediaRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getType($type)
    {
        return $this->createQueryBuilder('t')
            ->where('t.type = :type')

            ->setParameter('type', $type)

            ->getQuery()
            ->getOneOrNullResult();
    }
}
