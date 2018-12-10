<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateDTOHelperInterface;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksUpdateActionInterface;
use App\UI\Forms\UpdateTrickType;
use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksUpdateAction implements TricksUpdateActionInterface
{
    /** @var TricksUpdateResponderInterface */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var CreateTrickHandlerInterface */
    private $formHandler;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var HydrateDTOHelperInterface */
    private $hydrateDTOHelper;

    /**
     * TricksAddAction constructor.
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
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->entityManager = $entityManager;
        $this->hydrateDTOHelper = $hydrateDTOHelper;
    }

    /**
     * @Route("/tricks/update/{id}", name="tricks_update", requirements={"id":".+"})
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action(Request $request, $id):Response
    {
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->getTrick($id);

        $dto = $this->hydrateDTOHelper->hydrateUpdateTrickDTO($trick);

        $form = $this->formFactory
            ->create(UpdateTrickType::class, $dto)
            ->handleRequest($request);

        if ($this->formHandler->handle($form, $trick)) {
            return $this->responder->response(true);
        }

        return $this->responder->response(false, $form);
    }
}
