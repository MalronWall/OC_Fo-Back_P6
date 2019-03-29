<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\MediaInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\TypeMediaInterface;
use Ramsey\Uuid\UuidInterface;

class Media implements MediaInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $link;
    /** @var User */
    private $user;
    /** @var TypeMediaInterface */
    private $typeMedia;
    /** @var TrickInterface */
    private $trick;

    /**
     * Media constructor.
     * @param string $link
     * @param TypeMedia $typeMedia
     */
    public function __construct(string $link, TypeMedia $typeMedia)
    {
        $this->link = $link;
        $this->typeMedia = $typeMedia;
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return TrickInterface
     */
    public function getTrick(): TrickInterface
    {
        return $this->trick;
    }

    /**
     * @return TypeMediaInterface
     */
    public function getTypeMedia(): TypeMediaInterface
    {
        return $this->typeMedia;
    }
}
