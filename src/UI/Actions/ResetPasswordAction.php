<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\ResetPasswordHandlerInterface;
use App\Application\Helpers\Interfaces\ManageTokenHelperInterface;
use App\Domain\Models\User;
use App\UI\Actions\Interfaces\ResetPasswordActionInterface;
use App\UI\Forms\ResetPasswordType;
use App\UI\Responders\Interfaces\ResetPasswordResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordAction implements ResetPasswordActionInterface
{
    /** @var ResetPasswordResponderInterface */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var ResetPasswordHandlerInterface */
    private $formHandler;
    /** @var ManageTokenHelperInterface */
    private $manageTokenHelper;

    /**
     * ResetPasswordAction constructor.
     * @param ResetPasswordResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ResetPasswordHandlerInterface $formHandler
     * @param ManageTokenHelperInterface $manageTokenHelper
     */
    public function __construct(
        ResetPasswordResponderInterface $responder,
        FormFactoryInterface $formFactory,
        ResetPasswordHandlerInterface $formHandler,
        ManageTokenHelperInterface $manageTokenHelper
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->manageTokenHelper = $manageTokenHelper;
    }

    /**
     * @Route("/reset-password/{token}", name="reset_password", requirements={"token":".+"})
     * @param Request $request
     * @param $token
     * @return Response
     */
    public function action(Request $request, $token): Response
    {
        if (!is_null($user = $this->manageTokenHelper->checkTokenIsValid($token))) {
            $form = $this->formFactory
                ->create(ResetPasswordType::class)
                ->handleRequest($request);

            if (!($this->formHandler->handle($form, $user))) {
                return $this->responder->response(false, $form);
            }
        }

        return $this->responder->response(true);
    }
}
