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
     * @param null $join
     * @param int $numPage
     * @param int $nbToDisplay
     * @return mixed
     */
    public function nbPagesTot($repository, $join = null, $numPage = 1, $nbToDisplay = 10);
}