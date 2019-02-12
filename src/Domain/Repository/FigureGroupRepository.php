<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\FigureGroupRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class FigureGroupRepository extends EntityRepository implements FigureGroupRepositoryInterface
{

}
