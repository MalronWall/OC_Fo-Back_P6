<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\ForgotPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface ForgotPasswordActionInterface
{
    /**
     * ForgotPasswordActionInterface constructor.
     * @param ForgotPasswordResponderInterface $responder
     */
    public function __construct(
        ForgotPasswordResponderInterface $responder
    );

    /**
     * @return Response
     */
    public function action(): Response;
}
