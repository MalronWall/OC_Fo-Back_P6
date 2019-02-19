<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Media;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

interface TrickInterface
{
    /**
     * Trick constructor.
     * @param string $title
     * @param string $description
     * @param string $figureGroup
     */
    public function __construct(string $title, string $description, string $figureGroup);

    /**
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(UpdateTrickDTOInterface $dto): void;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getFigureGroup(): string;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return Media[]|Collection
     */
    public function getMedias(): Collection;
}