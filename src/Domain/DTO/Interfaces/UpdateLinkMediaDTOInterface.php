<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface UpdateLinkMediaDTOInterface
{
    /**
     * NewImageMediaDTO constructor.
     * @param null|string $link
     * @param null|string $alt
     */
    public function __construct(?string $link, ?string $alt);
}