<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

class PaginatorHelper
{
    public function nbPagesTot($repository, $nbToDisplay, $numPage)
    {
        // NB of entities of "repository" type in db
        $nbEntities = $repository->nbEntities();
        // NB of pages in total to display
        $nbPagesTot = ceil($nbEntities / $nbToDisplay);

        if ($nbPagesTot !== 0 && ($numPage < 1 || $numPage > $nbPagesTot)) {
            return null;
        }
        return $nbPagesTot;
    }
}
