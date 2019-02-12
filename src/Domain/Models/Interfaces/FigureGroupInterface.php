<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

interface FigureGroupInterface
{
    /**
     * TypeMedia constructor.
     * @param string $title
     */
    public function __construct(string $title);

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return ArrayCollection
     */
    public function getTricks(): ArrayCollection;
}
