<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\ForgotPasswordHandler;
use App\Application\Handlers\Forms\Interfaces\ForgotPasswordHandlerInterface;
use App\UI\Responders\Interfaces\ForgotPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ForgotPasswordActionInterface
{
    /**
     * ForgotPasswordActionInterface constructor.
     * @param ForgotPasswordResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ForgotPasswordHandlerInterface $formHandler
     */
    public function __construct(
        ForgotPasswordResponderInterface $responder,
        FormFactoryInterface $formFactory,
        ForgotPasswordHandlerInterface $formHandler
    );

    /**
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response;
}
