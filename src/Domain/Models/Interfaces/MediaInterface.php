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
     * @param string $alt
     * @param TypeMedia $typeMedia
     * @param bool $first
     */
    public function __construct(string $link, string $alt, TypeMedia $typeMedia, bool $first = false);

    /**
     * @param Trick $trick
     */
    public function defineTrick(Trick $trick): void;

    /**
     * @param string $link
     * @return Media
     */
    public function toEmbedLink(string $link): string;

    public function unsetFirst();

    /**
     * @param $link
     * @param $alt
     */
    public function updateMediaWithLink($link, $alt);

    /**
     * @param $alt
     * @param $link
     * @param $first
     */
    public function updateMediaWithImage($alt, $link, $first);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getLink(): string;

    /**
     * @return string
     */
    public function getAlt(): string;

    /**
     * @return bool
     */
    public function isFirst(): bool;

    /**
     * @return User
     */
    public function getUser(): User;

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface;

    /**
     * @return TypeMediaInterface
     */
    public function getTypeMedia(): TypeMediaInterface;
}