<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Application\Helpers\SafeRenameHelper;
use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\FigureGroupInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Trick implements TrickInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $slug;
    /** @var string */
    private $description;
    /** @var \DateTime */
    private $createdThe;
    /** @var \DateTime */
    private $updatedThe;
    /** @var FigureGroupInterface */
    private $figureGroup;
    /** @var User */
    private $userCreate;
    /** @var User */
    private $userUpdate;
    /** @var Collection|Media[] */
    private $medias;
    /** @var Collection|Comment[] */
    private $comments;

    /**
     * Trick constructor.
     * @param User $user
     * @param string $title
     * @param string $description
     * @param FigureGroupInterface $figureGroup
     */
    public function __construct(
        User $user,
        string $title,
        string $description,
        FigureGroupInterface $figureGroup
    ) {
        $this->userCreate = $user;
        $this->userUpdate = $user;
        $this->title = $title;
        $this->slug = SafeRenameHelper::slug($title);
        $this->description = $description;
        $this->createdThe = new \DateTime();
        $this->updatedThe = new \DateTime();
        $this->figureGroup = $figureGroup;
        $this->medias = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @param Comment $comment
     */
    public function addMedia(Media $media):void
    {
        $this->medias->add($media);
        $media->defineTrick($this);
    }

    /**
     * @param User $user
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(User $user, UpdateTrickDTOInterface $dto):void
    {
        /** @var UpdateTrickDTO $dto */
        $this->title = $dto->title;
        $this->slug = SafeRenameHelper::slug($dto->title);
        $this->description = $dto->description;
        $this->figureGroup = $dto->figureGroup;
        $this->userUpdate = $user;
        $this->updatedThe = new \DateTime();
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return FigureGroupInterface
     */
    public function getFigureGroup(): FigureGroupInterface
    {
        return $this->figureGroup;
    }

    /**
     * @return Media[]|Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedThe(): \DateTime
    {
        return $this->createdThe;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedThe(): \DateTime
    {
        return $this->updatedThe;
    }

    /**
     * @return User
     */
    public function getUserCreate(): User
    {
        return $this->userCreate;
    }

    /**
     * @return User
     */
    public function getUserUpdate(): User
    {
        return $this->userUpdate;
    }

    /**
     * @return Comment[]|Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
