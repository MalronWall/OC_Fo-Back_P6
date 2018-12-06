<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

interface TrickRepositoryInterface
{
    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $figureGroup
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function updateTrick($id, $title, $description, $figureGroup);

    /**
     * @param $title
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     */
    public function verifyUniqueTitle($title);
}
