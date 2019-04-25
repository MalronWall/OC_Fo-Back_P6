<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

interface TricksAddActionInterface
{
    /**
     * TricksAddActionInterface constructor.
     * @param TricksAddResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param CreateTrickHandlerInterface $formInterface
     * @param Security $security
     * @param SessionInterface $session
     */
    public function __construct(
        TricksAddResponderInterface $responder,
        FormFactoryInterface $formFactory,
        CreateTrickHandlerInterface $formInterface,
        Security $security,
        SessionInterface $session
    );

    /**
     * @param Request $request
     * @return Response
     */
    public function action(Request $request):Response;
}
