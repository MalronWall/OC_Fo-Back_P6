<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

interface TricksUpdateActionInterface
{
    /**
     * TricksUpdateActionInterface constructor.
     * @param TricksUpdateResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param UpdateTrickHandlerInterface $formHandler
     * @param EntityManagerInterface $entityManager
     * @param HydrateHelperInterface $hydrateDTOHelper
     * @param Security $security
     * @param SessionInterface $session
     */
    public function __construct(
        TricksUpdateResponderInterface $responder,
        FormFactoryInterface $formFactory,
        UpdateTrickHandlerInterface $formHandler,
        EntityManagerInterface $entityManager,
        HydrateHelperInterface $hydrateDTOHelper,
        Security $security,
        SessionInterface $session
    );

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function action(Request $request, $id):Response;
}
