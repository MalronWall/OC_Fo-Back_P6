<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\FigureGroupInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class FigureGroup implements FigureGroupInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $title;
    /** @var ArrayCollection */
    private $tricks;

    /**
     * TypeMedia constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->type = $title;
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
     * @return ArrayCollection
     */
    public function getTricks(): ArrayCollection
    {
        return $this->tricks;
    }
}
