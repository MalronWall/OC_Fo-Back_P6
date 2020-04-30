<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Models;

use App\Application\Helpers\SafeRenameHelper;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface as UISymfony;

class User implements UISymfony
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $username;
    /** @var string */
    private $slug;
    /** @var string */
    private $email;
    /** @var string */
    private $password;
    /** @var string */
    private $tokenForgotPwd;
    /** @var \DateTime */
    private $tokenDateForgotPwd;
    /** @var array */
    private $roles;
    /** @var Media */
    private $media;

    /**
     * User constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->slug = SafeRenameHelper::slug($username);
        $this->email = $email;
        $this->password = $password;
        $this->roles[] = "ROLE_USER";
    }

    /**
     * @param $token
     * @throws \Exception
     */
    public function createTokenForgotPwdInformations($token)
    {
        $this->tokenForgotPwd = $token;
        $this->tokenDateForgotPwd = (new \DateTime())->add(new \DateInterval('P1D'));
    }

    /**
     * @param $encodedPwd
     */
    public function resetPwd($encodedPwd)
    {
        $this->password = $encodedPwd;
        $this->tokenForgotPwd = null;
        $this->tokenDateForgotPwd = null;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getTokenForgotPwd(): string
    {
        return $this->tokenForgotPwd;
    }

    /**
     * @return \DateTime
     */
    public function getTokenDateForgotPwd(): \DateTime
    {
        return $this->tokenDateForgotPwd;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

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
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return;
    }
}
