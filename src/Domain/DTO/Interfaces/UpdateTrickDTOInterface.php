<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface UpdateTrickDTOInterface
{
    /**
     * UpdateTrickDTOInterface constructor.
     * @param null|string $title
     * @param null|string $description
     * @param null|string $figureGroup
     * @param null|UuidInterface $id
     */
    public function __construct(
        ?string $title,
        ?string $description,
        ?string $figureGroup,
        ?UuidInterface $id = null
    );
}
