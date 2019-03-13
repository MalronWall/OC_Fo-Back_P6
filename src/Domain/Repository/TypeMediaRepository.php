<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\TypeMediaRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class TypeMediaRepository extends EntityRepository implements TypeMediaRepositoryInterface
{

}
