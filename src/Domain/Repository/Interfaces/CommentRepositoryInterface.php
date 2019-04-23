<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

interface CommentRepositoryInterface
{
    /**
     * @param $trick
     * @return mixed
     */
    public function getComments($trick);

    /**
     * @param $trick
     * @param int $numPage
     * @param int $nbToDisplay
     * @return mixed
     */
    public function getCommentsFrom($trick, int $numPage = 1, int $nbToDisplay = 10);

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function nbEntities();
}
