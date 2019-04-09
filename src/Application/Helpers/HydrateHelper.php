<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Trick;

class HydrateHelper implements HydrateHelperInterface
{
    /**
     * @param TrickInterface $trick
     * @return UpdateTrickDTO
     */
    public function hydrateUpdateTrickDTO(TrickInterface $trick):UpdateTrickDTO
    {
        return new UpdateTrickDTO(
            $trick->getTitle(),
            $trick->getDescription(),
            $trick->getFigureGroup(),
            $trick->getId()
        );
    }

    /**
     * @param TrickInterface $trick
     * @return Trick
     */
    public function hydrateTrick(TrickInterface $trick):Trick
    {
        return new Trick(
            $trick->getUser(),
            $trick->getTitle(),
            $trick->getDescription(),
            $trick->getFigureGroup(),
            $trick->getLinks()->toArray(),
            $trick->getImages()->toArray()
        );
    }
}
