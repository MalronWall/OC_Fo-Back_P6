<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Application\Helpers\SafeRenameHelper;
use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
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
    /** @var FigureGroupInterface */
    private $figureGroup;
    /** @var User */
    private $user;
    /** @var Collection|Media[] */
    private $links;
    /** @var Collection|Media[] */
    private $images;

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
        $this->user = $user;
        $this->title = $title;
        $this->slug = SafeRenameHelper::slug($title);
        $this->description = $description;
        $this->figureGroup = $figureGroup;
        $this->links = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    /**
     * @param Media $link
     */
    public function addLink(Media $link):void
    {
        $this->links->add($link);
        $link->defineTrick($this);
    }
    /**
     * @param Media $image
     */
    public function addImage(Media $image):void
    {
        $this->images->add($image);
        $image->defineTrick($this);
    }

    /**
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(UpdateTrickDTOInterface $dto):void
    {
        $this->title = $dto->title;
        $this->slug = SafeRenameHelper::slug($dto->title);
        $this->description = $dto->description;
        $this->figureGroup = $dto->figureGroup;
        $this->links = new ArrayCollection($dto->links);
        $this->images = new ArrayCollection($dto->images);
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Media[]|Collection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return Media[]|Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
