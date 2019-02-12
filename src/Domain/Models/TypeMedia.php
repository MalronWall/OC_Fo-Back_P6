<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\TypeMediaInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class TypeMedia implements TypeMediaInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $type;
    /** @var ArrayCollection */
    private $medias;

    /**
     * TypeMedia constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return ArrayCollection
     */
    public function getMedias(): ArrayCollection
    {
        return $this->medias;
    }
}
