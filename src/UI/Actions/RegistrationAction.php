<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\RegistrationHandlerInterface;
use App\Application\Handlers\Forms\RegistrationHandler;
use App\UI\Actions\Interfaces\RegistrationActionInterface;
use App\UI\Forms\RegistrationType;
use App\UI\Responders\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationAction implements RegistrationActionInterface
{
    /** @var RegistrationResponderInterface  */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var RegistrationHandlerInterface */
    private $formHandler;

    /**
     * RegistrationAction constructor.
     * @param RegistrationResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param RegistrationHandlerInterface $formHandler
     */
    public function __construct(
        RegistrationResponderInterface $responder,
        FormFactoryInterface $formFactory,
        RegistrationHandlerInterface $formHandler
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }

    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response
    {
        $form = $this->formFactory
            ->create(RegistrationType::class)
            ->handleRequest($request);
        if ($this->formHandler->handle($form)) {
            return $this->responder->response(true);
        }
        return $this->responder->response(false, $form);
    }
}
