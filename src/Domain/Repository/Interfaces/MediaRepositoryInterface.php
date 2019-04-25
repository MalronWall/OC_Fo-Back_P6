<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

interface MediaRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMedia($id);

    /**
     * @param $trick
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function unsetFirstDb($trick);
}
