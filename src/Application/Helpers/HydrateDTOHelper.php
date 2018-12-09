<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\HydrateDTOHelperInterface;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;

class HydrateDTOHelper implements HydrateDTOHelperInterface
{
    /**
     * @param TrickInterface $trick
     * @return UpdateTrickDTO
     */
    public function hydrateUpdateTrickDTO(TrickInterface $trick):UpdateTrickDTO
    {
        return new UpdateTrickDTO($trick->getTitle(), $trick->getDescription(), $trick->getGroup(), $trick->getId());
    }
}
