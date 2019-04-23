<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

interface TrickRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getTricks();

    /**
     * @param int $numPage
     * @param int $nbToDisplay
     * @return mixed
     */
    public function getTricksFrom(int $numPage = 1, int $nbToDisplay = 10);

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function nbEntities();

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
