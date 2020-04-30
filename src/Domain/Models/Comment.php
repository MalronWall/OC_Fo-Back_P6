<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\CommentInterface;
use Ramsey\Uuid\UuidInterface;

class Comment implements CommentInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $comment;
    /** @var \DateTime */
    private $createdThe;
    /** @var User */
    private $userCreate;
    /** @var Trick */
    private $trick;

    /**
     * Comment constructor.
     * @param User $user
     * @param string $comment
     * @param Trick $trick
     */
    public function __construct(User $user, string $comment, Trick $trick)
    {
        $this->userCreate = $user;
        $this->comment = $comment;
        $this->trick = $trick;
        $this->createdThe = new \DateTime();
    }

    /**
     * @param Trick $trick
     */
    public function defineTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedThe(): \DateTime
    {
        return $this->createdThe;
    }

    /**
     * @return User
     */
    public function getUserCreate(): User
    {
        return $this->userCreate;
    }

    /**
     * @return Trick
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }
}
