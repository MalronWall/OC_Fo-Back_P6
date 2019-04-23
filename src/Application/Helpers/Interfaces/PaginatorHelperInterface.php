<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

interface PaginatorHelperInterface
{
    /**
     * @param $repository
     * @param $numPage
     * @param int $nbToDisplay
     * @return mixed
     */
    public function nbPagesTot($repository, $numPage = 1, $nbToDisplay = 10);
}