<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\ForgotPasswordActionInterface;
use App\UI\Responders\Interfaces\ForgotPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordAction implements ForgotPasswordActionInterface
{
    private $responder;

    /**
     * ForgotPasswordAction constructor.
     * @param ForgotPasswordResponderInterface $responder
     */
    public function __construct(
        ForgotPasswordResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/forgot-password", name="forgot_password")
     */
    public function action(): Response
    {
        return $this->responder->response();
    }
}
