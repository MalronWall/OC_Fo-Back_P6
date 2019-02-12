<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

interface UserInterface
{
    /**
     * UserInterface constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $username,
        string $email,
        string $password
    );

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return Media
     */
    public function getMedia(): Media;

    /**
     * @return ArrayCollection
     */
    public function getTricks(): ArrayCollection;
}
