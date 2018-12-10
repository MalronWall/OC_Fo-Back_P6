<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateDTOHelperInterface;
use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface TricksUpdateActionInterface
{
    /**
     * TricksUpdateActionInterface constructor.
     * @param TricksUpdateResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param UpdateTrickHandlerInterface $formHandler
     * @param EntityManagerInterface $entityManager
     * @param HydrateDTOHelperInterface $hydrateDTOHelper
     */
    public function __construct(
        TricksUpdateResponderInterface $responder,
        FormFactoryInterface $formFactory,
        UpdateTrickHandlerInterface $formHandler,
        EntityManagerInterface $entityManager,
        HydrateDTOHelperInterface $hydrateDTOHelper
    );

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function action(Request $request, $id):Response;
}
