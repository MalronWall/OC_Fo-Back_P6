<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;

class PaginatorHelper implements PaginatorHelperInterface
{
    /**
     * @param $repository
     * @param null $join
     * @param int $numPage
     * @param int $nbToDisplay
     * @return int|mixed|null
     */
    public function nbPagesTot($repository, $join = null, $numPage = 1, $nbToDisplay = 10)
    {
        // NB of entities of "repository" type in db
        $nbEntities = $repository->nbEntities($join);
        // NB of pages in total to display
        $nbPagesTot = (int)ceil($nbEntities / $nbToDisplay);

        if ($nbPagesTot !== 0 && ($numPage < 1 || $numPage > $nbPagesTot)) {
            return null;
        }
        return $nbPagesTot;
    }
}
