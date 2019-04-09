<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\MediaInterface;
use Doctrine\ORM\EntityRepository;

class Media extends EntityRepository implements MediaInterface
{

}
