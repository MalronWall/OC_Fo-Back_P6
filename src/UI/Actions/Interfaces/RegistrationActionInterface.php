<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\RegistrationHandlerInterface;
use App\UI\Responders\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RegistrationActionInterface
{
    /**
     * RegistrationActionInterface constructor.
     * @param RegistrationResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param RegistrationHandlerInterface $formHandler
     */
    public function __construct(
        RegistrationResponderInterface $responder,
        FormFactoryInterface $formFactory,
        RegistrationHandlerInterface $formHandler
    );

    /**
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response;
}
