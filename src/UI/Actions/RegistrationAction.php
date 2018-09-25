<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\RegistrationActionInterface;
use App\UI\Responders\Interfaces\RegistrationResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationAction implements RegistrationActionInterface
{
    private $responder;

    /**
     * RegistrationAction constructor.
     * @param RegistrationResponderInterface $responder
     */
    public function __construct(
        RegistrationResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function action(): Response
    {
        return $this->responder->response();
    }
}
