<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

interface TrickRepositoryInterface
{
    /**
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTrick($slug);

    /**
     * @param $title
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function verifyUniqueTitle($title);
}
