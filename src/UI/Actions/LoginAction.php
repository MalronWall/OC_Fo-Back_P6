<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\LoginActionInterface;
use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginAction implements LoginActionInterface
{
    private $responder;

    /**
     * LoginAction constructor.
     * @param LoginResponderInterface $responder
     */
    public function __construct(
        LoginResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/login", name="login")
     */
    public function action(): Response
    {
        return $this->responder->response();
    }
}
