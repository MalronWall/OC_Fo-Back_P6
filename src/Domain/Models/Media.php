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
    /** @var string */
    private $alt;
    /** @var User */
    private $user;
    /** @var TypeMediaInterface */
    private $typeMedia;
    /** @var TrickInterface */
    private $trick;
    /** @var bool */
    private $first;

    /**
     * Media constructor.
     * @param string $link
     * @param string $alt
     * @param TypeMedia $typeMedia
     * @param bool|null $first
     */
    public function __construct(string $link, string $alt, TypeMedia $typeMedia, ?bool $first = false)
    {
        $embedLink = $this->toEmbedLink($link);
        $this->link = $embedLink;
        $this->alt = $alt;
        $this->typeMedia = $typeMedia;
        $this->first = $first;
    }

    /**
     * @param TrickInterface $trick
     */
    public function defineTrick(TrickInterface $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @param string $link
     * @return Media
     */
    public function toEmbedLink(string $link): string
    {
        if (preg_match('/www\.youtube\.com\//', $link)) {
            $link = str_replace("watch?v=", "embed/", $link);
            $link = preg_replace('/&list/', "?list", $link);
            $link = preg_replace('/&index=./', "", $link);
            $link = preg_replace('/&start_radio=./', "", $link);
        }
        return $link;
    }

    public function unsetFirst()
    {
        $this->first = false;
    }

    /**
     * @param $link
     * @param $alt
     */
    public function updateMediaWithLink($link, $alt)
    {
        if (!is_null($alt)) {
            $this->alt = $alt;
        }
        if (!is_null($link)) {
            $this->link = $this->toEmbedLink($link);
        }
    }

    /**
     * @param $link
     * @param $alt
     * @param $first
     */
    public function updateMediaWithImage($link, $alt, $first)
    {
        if (!is_null($link)) {
            $this->link = $link;
        }
        if (!is_null($alt)) {
            $this->alt = $alt;
        }
        if (!is_null($first)) {
            $this->first = $first;
        }
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
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->first;
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
