<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

interface LoginActionInterface
{
    /**
     * LoginActionInterface constructor.
     * @param LoginResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param AuthenticationUtils $authenError
     */
    public function __construct(
        LoginResponderInterface $responder,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenError
    );

    /**
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response;
}
