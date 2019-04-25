<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\Domain\DTO\UpdateImageMediaDTO;
use App\Domain\DTO\UpdateLinkMediaDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\MediaInterface;
use App\Domain\Models\Interfaces\TrickInterface;

class HydrateHelper implements HydrateHelperInterface
{
    /**
     * @param TrickInterface $trick
     * @return UpdateTrickDTO
     */
    public function hydrateUpdateTrickDTO(TrickInterface $trick):UpdateTrickDTO
    {
        return new UpdateTrickDTO(
            $trick->getId(),
            $trick->getTitle(),
            $trick->getDescription(),
            $trick->getFigureGroup()
        );
    }

    /**
     * @param MediaInterface $media
     * @return UpdateImageMediaDTO|UpdateLinkMediaDTO|null
     */
    public function hydrateUpdateMediaDTO(MediaInterface $media)
    {
        switch ($media->getTypeMedia()->getType()) {
            case "image":
                return new UpdateImageMediaDTO(
                    $media->getAlt(),
                    $media->isFirst()
                );
            case "video":
                return new UpdateLinkMediaDTO(
                    $media->getLink(),
                    $media->getAlt()
                );
            default:
                return null;
        }
    }
}
