<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\LoginHandlerInterface;
use App\UI\Actions\Interfaces\LoginActionInterface;
use App\UI\Forms\LoginType;
use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginAction implements LoginActionInterface
{
    /** @var LoginResponderInterface  */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var AuthenticationUtils */
    private $authenError;

    /**
     * LoginAction constructor.
     * @param LoginResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param AuthenticationUtils $authenError
     */
    public function __construct(
        LoginResponderInterface $responder,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenError
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->authenError = $authenError;
    }

    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response
    {
        $error = $this->authenError->getLastAuthenticationError();

        $form = $this->formFactory
            ->create(LoginType::class);
        return $this->responder->response(false, $form, $error);
    }
}
