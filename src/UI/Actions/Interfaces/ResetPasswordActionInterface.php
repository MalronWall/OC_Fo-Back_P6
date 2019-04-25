<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\ResetPasswordHandlerInterface;
use App\Application\Helpers\Interfaces\ManageTokenHelperInterface;
use App\UI\Responders\Interfaces\ResetPasswordResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ResetPasswordActionInterface
{
    /**
     * ResetPasswordActionInterface constructor.
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
    );

    /**
     * @param Request $request
     * @param $token
     * @return Response
     */
    public function action(Request $request, $token): Response;
}
