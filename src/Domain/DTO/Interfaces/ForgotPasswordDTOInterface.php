<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO\Interfaces;

interface ForgotPasswordDTOInterface
{
    /**
     * RegistrationDTO constructor.
     * @param null|string $email
     */
    public function __construct(?string $email);
}