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

interface TricksAddActionInterface
{
    /**
     * TricksAddActionInterface constructor.
     * @param TricksAddResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param CreateTrickHandlerInterface $formInterface
     */
    public function __construct(
        TricksAddResponderInterface $responder,
        FormFactoryInterface $formFactory,
        CreateTrickHandlerInterface $formInterface
    );

    /**
     * @param Request $request
     * @return Response
     */
    public function action(Request $request):Response;
}
