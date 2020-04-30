<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Trick;
use App\Domain\Models\User;
use Ramsey\Uuid\UuidInterface;

interface CommentInterface
{
    /**
     * @param Trick $trick
     */
    public function defineTrick(Trick $trick): void;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @return \DateTime
     */
    public function getCreatedThe(): \DateTime;

    /**
     * @return User
     */
    public function getUserCreate(): User;

    /**
     * @return Trick
     */
    public function getTrick(): Trick;
}
