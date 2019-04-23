<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;

class PaginatorHelper implements PaginatorHelperInterface
{
    public function nbPagesTot($repository, $numPage = 1, $nbToDisplay = 10)
    {
        // NB of entities of "repository" type in db
        $nbEntities = $repository->nbEntities();
        // NB of pages in total to display
        $nbPagesTot = (int)ceil($nbEntities / $nbToDisplay);

        if ($nbPagesTot !== 0 && ($numPage < 1 || $numPage > $nbPagesTot)) {
            return null;
        }
        return $nbPagesTot;
    }
}
