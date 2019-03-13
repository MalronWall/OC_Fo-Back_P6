<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Application\Helpers\SafeRenameHelper;
use App\Domain\DTO\Interfaces\NewImageMediaDTOInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

class NewImageMediaDTO implements NewImageMediaDTOInterface
{
    /**
     * @var File
     *
     * @Assert\File(
     *     maxSize = "1000m",
     *     maxSizeMessage = "Taille maximale autorisée : 1 Go.",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Format accepté : jpg, jpeg, png."
     * )
     */
    public $image;

    /**
     * NewImageMediaDTO constructor.
     * @param null|UploadedFile $image
     */
    public function __construct(?UploadedFile $image)
    {
        $this->image = $image;
    }
}
