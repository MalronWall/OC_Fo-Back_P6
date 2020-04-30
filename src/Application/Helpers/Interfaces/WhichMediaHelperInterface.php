<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

interface WhichMediaHelperInterface
{
    /**
     * @param $dto
     * @return string
     */
    public function getMediaType($dto);
}