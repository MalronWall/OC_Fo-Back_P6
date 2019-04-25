<?php
/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface CreateCommentDTOInterface
{
    /**
     * CreateCommentDTOInterface constructor.
     * @param null|string $comment
     */
    public function __construct(?string $comment);
}