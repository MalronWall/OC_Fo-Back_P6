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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->link = $typeMedia->getType() === "video" ? $this->toEmbedLink($link) : $link;
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
        // $matches[0] => url / $matches[1] => id video
        preg_match(
            "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
            $link,
            $matches
        );

        $link = "Link error : please give a youtube url";
        if (!empty($matches)) {
            $idVideo = $matches[1];

            // Check if the video exists
            $checkURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$idVideo&format=json";
            $headers = get_headers($checkURL);
            $existsURL = (substr($headers[0], 9, 3) !== "404" && substr($headers[0], 9, 3) !== "401");

            $link = "Video with id '$idVideo' not exist";
            if ($existsURL) {
                $link = $idVideo;
            }
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
