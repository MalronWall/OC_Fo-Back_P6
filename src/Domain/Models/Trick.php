<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Interfaces\FigureGroupInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Trick implements TrickInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var FigureGroupInterface */
    private $figureGroup;
    /** @var UserInterface */
    private $user;
    /** @var ArrayCollection */
    private $medias;

    /**
     * Trick constructor.
     * @param string $title
     * @param string $description
     * @param string $figureGroup
     */
    public function __construct(string $title, string $description, string $figureGroup)
    {
        $this->title = $title;
        $this->description = $description;
        $this->figureGroup = $figureGroup;
    }

    /**
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(UpdateTrickDTOInterface $dto):void
    {
        $this->title = $dto->title;
        $this->description = $dto->description;
        $this->figureGroup = $dto->figureGroup;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getFigureGroup(): string
    {
        return $this->figureGroup;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return ArrayCollection
     */
    public function getMedias(): ArrayCollection
    {
        return $this->medias;
    }
}
