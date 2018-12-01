<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUsernameInDb extends Constraint
{
    public $message = 'These data already exist in the database';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
