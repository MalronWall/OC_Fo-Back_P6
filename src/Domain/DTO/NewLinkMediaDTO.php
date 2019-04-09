<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewLinkMediaDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewLinkMediaDTO implements NewLinkMediaDTOInterface
{
    /** @var string
     * @Assert\NotBlank(
     *      message="Entrez un lien ou supprimer cet emplacement !"
     * )
     */
    public $link;

    /** @var string
     * @Assert\NotNull(
     *      message="Renseignez un descriptif pour cette vidéo !"
     * )
     */
    public $alt;

    /**
     * NewLinkMediaDTO constructor.
     * @param string $link
     * @param null|string $alt
     */
    public function __construct(?string $link, ?string $alt)
    {
        $this->link = $link;
        $this->alt = $alt;
    }
}
