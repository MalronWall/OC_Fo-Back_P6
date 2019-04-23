<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface ResetPasswordDTOInterface
{
    /**
     * RegistrationDTO constructor.
     * @param null|string $email
     * @param null|string $password
     */
    public function __construct(?string $email, ?string $password);
}