<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\TrickInterface;
use Ramsey\Uuid\UuidInterface;

class Trick implements TrickInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var string */
    private $figureGroup;

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
    public function getGroup(): string
    {
        return $this->figureGroup;
    }
}
