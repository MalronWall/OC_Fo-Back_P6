<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\TypeMedia;
use Ramsey\Uuid\UuidInterface;

interface MediaInterface
{
    /**
     * Media constructor.
     * @param string $link
     * @param TypeMedia $typeMedia
     */
    public function __construct(string $link, TypeMedia $typeMedia);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getLink(): string;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return TypeMediaInterface
     */
    public function getTypeMedia(): TypeMediaInterface;

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface;
}
