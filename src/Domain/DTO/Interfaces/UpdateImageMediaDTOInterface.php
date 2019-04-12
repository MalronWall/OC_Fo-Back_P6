<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface UpdateImageMediaDTOInterface
{
    /**
     * NewImageMediaDTO constructor.
     * @param null|string $alt
     * @param bool|null $first
     */
    public function __construct(?string $alt, ?bool $first);
}