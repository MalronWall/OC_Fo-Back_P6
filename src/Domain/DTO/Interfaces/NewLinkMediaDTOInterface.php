<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface NewLinkMediaDTOInterface
{
    /**
     * NewLinkMediaDTO constructor.
     * @param string $link
     */
    public function __construct(?string $link);
}
