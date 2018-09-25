<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface ResetPasswordActionInterface
{
    /**
     * ResetPasswordActionInterface constructor.
     * @param ResetPasswordResponderInterface $responder
     */
    public function __construct(
        ResetPasswordResponderInterface $responder
    );

    /**
     * @param $token
     * @return Response
     */
    public function action($token): Response;
}
