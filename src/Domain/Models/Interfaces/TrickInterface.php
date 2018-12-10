<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use Ramsey\Uuid\UuidInterface;

interface TrickInterface
{
    /**
     * TrickInterface constructor.
     * @param string $title
     * @param string $description
     * @param string $figureGroup
     */
    public function __construct(
        string $title,
        string $description,
        string $figureGroup
    );

    /**
     * @param UpdateTrickDTOInterface $dto
     */
    public function updateTrick(UpdateTrickDTOInterface $dto):void;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getGroup(): string;
}
