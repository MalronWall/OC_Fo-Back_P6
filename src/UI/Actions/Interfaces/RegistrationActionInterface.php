<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\RegistrationResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface RegistrationActionInterface
{
    /**
     * RegistrationActionInterface constructor.
     * @param RegistrationResponderInterface $responder
     */
    public function __construct(
        RegistrationResponderInterface $responder
    );

    /**
     * @return Response
     */
    public function action(): Response;
}
