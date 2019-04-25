<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

use App\Domain\DTO\UpdateImageMediaDTO;
use App\Domain\DTO\UpdateLinkMediaDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\MediaInterface;
use App\Domain\Models\Interfaces\TrickInterface;

interface HydrateHelperInterface
{
    /**
     * @param TrickInterface $trick
     * @return UpdateTrickDTO
     */
    public function hydrateUpdateTrickDTO(TrickInterface $trick):UpdateTrickDTO;

    /**
     * @param MediaInterface $media
     * @return UpdateImageMediaDTO|UpdateLinkMediaDTO|null
     */
    public function hydrateUpdateMediaDTO(MediaInterface $media);
}
