<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\WhichMediaHelperInterface;
use App\Domain\DTO\UpdateImageMediaDTO;
use App\UI\Forms\UpdateImageMediaType;
use App\UI\Forms\UpdateLinkMediaType;

class WhichMediaHelper implements WhichMediaHelperInterface
{
    /**
     * @param $dto
     * @return string
     */
    public function getMediaType($dto)
    {
        return get_class($dto) === UpdateImageMediaDTO::class ?
            UpdateImageMediaType::class :
            UpdateLinkMediaType::class;
    }
}
