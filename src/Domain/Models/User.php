<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\UuidInterface;

class User implements UserInterface
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $username;
    /** @var string */
    private $email;
    /** @var string */
    private $password;

    /**
     * UserInterface constructor.
     * @param string $username
     * @param string $email
     */
    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
