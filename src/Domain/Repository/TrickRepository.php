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
    public function getTrick($id)
    {
        return $this->createQueryBuilder('t')
            ->where('t.id = :id')

            ->setParameter('id', $id)

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritdoc
     */
    public function verifyUniqueTitle($title, $id = null)
    {
        if ($id) {
            $sql = <<<SQL
SELECT *
FROM trick
WHERE title = '$title' AND id <> '$id'
SQL;
        } else {
            $sql = <<<SQL
SELECT *
FROM trick
WHERE title = '$title'
SQL;
        }

        $statement = $this->getEntityManager()->getConnection()->prepare($sql);
        $statement->execute();

        return $statement->fetch();
    }
}
