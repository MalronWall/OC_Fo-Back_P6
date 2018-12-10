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
    public function updateTrick($id, $title, $description, $figureGroup)
    {
        $sql = <<<SQL
UPDATE trick
SET title = '$title', description = '$description', figure_group = '$figureGroup'
WHERE id = '$id'
SQL;
        $statement = $this->getEntityManager()->getConnection()->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @inheritdoc
     */
    public function verifyUniqueTitle($title)
    {
        $sql = <<<SQL
SELECT *
FROM trick
WHERE title = '$title'
SQL;
        $statement = $this->getEntityManager()->getConnection()->prepare($sql);
        $statement->execute();

        return $statement->fetch();
    }
}
