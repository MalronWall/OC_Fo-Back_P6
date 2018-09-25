<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\ResetPasswordActionInterface;
use App\UI\Responders\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordAction implements ResetPasswordActionInterface
{
    private $responder;

    /**
     * ResetPasswordAction constructor.
     * @param ResetPasswordResponderInterface $responder
     */
    public function __construct(
        ResetPasswordResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/reset-password/{token}", name="reset_password", requirements={"token":".+"})
     * @param $token
     * @return Response
     */
    public function action($token): Response
    {
        return $this->responder->response();
    }
}
