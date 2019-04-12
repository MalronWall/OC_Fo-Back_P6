<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateImageMediaDTOInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateImageMediaDTO implements UpdateImageMediaDTOInterface
{
    /**
     * @var File
     * @Assert\File(
     *     maxSize = "1000m",
     *     maxSizeMessage = "Taille maximale autorisée : 1 Go.",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Format accepté : jpg, jpeg, png.")
     * )
     */
    public $image;

    /** @var string
     * @Assert\NotNull(
     *      message="Renseignez un descriptif pour cette image !"
     * )
     */
    public $alt;

    /** @var bool|null */
    public $first;

    /**
     * NewImageMediaDTO constructor.
     * @param null|string $alt
     * @param bool|null $first
     */
    public function __construct(?string $alt, ?bool $first)
    {
        $this->alt = $alt;
        $this->first = $first;
    }
}
