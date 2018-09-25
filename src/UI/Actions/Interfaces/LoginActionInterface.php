<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface LoginActionInterface
{
    /**
     * LoginActionInterface constructor.
     * @param LoginResponderInterface $responder
     */
    public function __construct(
        LoginResponderInterface $responder
    );

    /**
     * @return Response
     */
    public function action(): Response;
}
