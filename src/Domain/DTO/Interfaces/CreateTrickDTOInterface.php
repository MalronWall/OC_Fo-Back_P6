<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\FigureGroupInterface;
use App\Validator\Constraints\UniqueTitleInDb;

/**
 * @UniqueTitleInDb(
 *     message="Ce titre existe déjà !"
 * )
 */
interface CreateTrickDTOInterface
{
    /**
     * CreateTrickDTO constructor.
     * @param null|string $title
     * @param null|string $description
     * @param FigureGroupInterface|null $figureGroup
     * @param array|null $links
     * @param array|null $images
     */
    public function __construct(
        ?string $title,
        ?string $description,
        ?FigureGroupInterface $figureGroup,
        ?array $links,
        ?array $images
    );
}
