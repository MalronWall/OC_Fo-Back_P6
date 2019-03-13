<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface NewImageMediaDTOInterface
{
    /**
     * NewImageMediaDTO constructor.
     * @param null|UploadedFile $image
     */
    public function __construct(?UploadedFile $image);
}