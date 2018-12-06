<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface CreateTrickDTOInterface
{
    /**
     * CreateTrickDTOInterface constructor.
     * @param null|string $title
     * @param null|string $description
     * @param null|string $figureGroup
     */
    public function __construct(?string $title, ?string $description, ?string $figureGroup);
}
