<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\FigureGroupInterface;
use Ramsey\Uuid\UuidInterface;

interface UpdateTrickDTOInterface
{
    /**
     * UpdateTrickDTOInterface constructor.
     * @param null|UuidInterface $id
     * @param null|string $title
     * @param null|string $description
     * @param FigureGroupInterface $figureGroup
     */
    public function __construct(
        ?UuidInterface $id,
        ?string $title,
        ?string $description,
        ?FigureGroupInterface $figureGroup
    );
}
