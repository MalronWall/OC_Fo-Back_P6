<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Media;
use Ramsey\Uuid\UuidInterface;

interface UserInterface
{
    /**
     * User constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $username, string $email, string $password);

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
    public function getSlug(): string;

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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles();

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt();

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials();
}