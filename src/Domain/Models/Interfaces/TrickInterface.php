<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Media;
use App\Domain\Models\User;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

interface TrickInterface
{
    /**
     * @param Media $media
     */
    public function addMedia(Media $media): void;

    /**
     * @param User $user
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(User $user, UpdateTrickDTOInterface $dto): void;

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
     * @return FigureGroupInterface
     */
    public function getFigureGroup(): FigureGroupInterface;

    /**
     * @return Media[]|Collection
     */
    public function getMedias();

    /**
     * @return \DateTime
     */
    public function getCreatedThe(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getUpdatedThe(): \DateTime;

    /**
     * @return User
     */
    public function getUserCreate(): User;

    /**
     * @return User
     */
    public function getUserUpdate(): User;

    /**
     * @return Comment[]|Collection
     */
    public function getComments();
}