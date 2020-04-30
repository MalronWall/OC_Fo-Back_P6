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
     * @param Media $link
     */
    public function addLink(Media $link): void;

    /**
     * @param Media $image
     */
    public function addImage(Media $image): void;

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void;

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
    public function getLinks();

    /**
     * @return Media[]|Collection
     */
    public function getImages();

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
