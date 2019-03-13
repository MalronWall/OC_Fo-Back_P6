<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewLinkMediaDTOInterface;

class NewLinkMediaDTO implements NewLinkMediaDTOInterface
{
    /** @var string */
    public $link;

    /**
     * NewLinkMediaDTO constructor.
     * @param string $link
     */
    public function __construct(?string $link)
    {
        $this->link = $link;
    }
}
