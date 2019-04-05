<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Media;
use App\Domain\Models\Trick;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
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
     * @param Trick $trick
     */
    public function defineTrick(Trick $trick): void;

    /**
     * @param string $link
     * @return Media
     */
    public function toEmbedLink(string $link): string;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getLink(): string;

    /**
     * @return User
     */
    public function getUser(): User;

    /**
     * @return TypeMediaInterface
     */
    public function getTypeMedia(): TypeMediaInterface;

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface;
}
