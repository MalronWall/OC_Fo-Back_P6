<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\UuidInterface;

interface MediaInterface
{
    /**
     * Media constructor.
     * @param string $name
     * @param string $link
     */
    public function __construct(string $name, string $link = null);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getName(): string;

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
