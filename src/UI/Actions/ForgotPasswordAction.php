<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\ForgotPasswordHandlerInterface;
use App\UI\Actions\Interfaces\ForgotPasswordActionInterface;
use App\UI\Forms\ForgotPasswordType;
use App\UI\Responders\Interfaces\ForgotPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordAction implements ForgotPasswordActionInterface
{
    /** @var ForgotPasswordResponderInterface */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var ForgotPasswordHandlerInterface */
    private $formHandler;

    /**
     * ForgotPasswordAction constructor.
     * @param ForgotPasswordResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ForgotPasswordHandlerInterface $formHandler
     */
    public function __construct(
        ForgotPasswordResponderInterface $responder,
        FormFactoryInterface $formFactory,
        ForgotPasswordHandlerInterface $formHandler
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }

    /**
     * @Route("/forgot-password", name="forgot_password")
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response
    {
        $form = $this->formFactory
            ->create(ForgotPasswordType::class)
            ->handleRequest($request);

        if (!($this->formHandler->handle($form))) {
            return $this->responder->response(false, $form);
        }

        return $this->responder->response(true);
    }
}
