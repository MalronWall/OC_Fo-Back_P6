<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Trick;

interface HydrateHelperInterface
{
    /**
     * @param TrickInterface $trick
     * @return UpdateTrickDTO
     */
    public function hydrateUpdateTrickDTO(TrickInterface $trick):UpdateTrickDTO;

    /**
     * @param TrickInterface $trick
     * @return Trick
     */
    public function hydrateTrick(TrickInterface $trick):Trick;
}
