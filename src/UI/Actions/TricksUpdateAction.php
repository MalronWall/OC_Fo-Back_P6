<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksUpdateActionInterface;
use App\UI\Forms\UpdateTrickType;
use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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
    /** @var HydrateHelperInterface */
    private $hydrateDTOHelper;
    /** @var Security */
    private $security;
    /** @var SessionInterface */
    private $session;

    /**
     * TricksAddAction constructor.
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
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->entityManager = $entityManager;
        $this->hydrateDTOHelper = $hydrateDTOHelper;
        $this->security = $security;
        $this->session = $session;
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
        if ($this->security->isGranted('ROLE_USER')) {
            $trick = $this->entityManager
                ->getRepository(Trick::class)
                ->getTrick($id);

            $dto = $this->hydrateDTOHelper->hydrateUpdateTrickDTO($trick);

            $form = $this->formFactory
                ->create(UpdateTrickType::class, $dto)
                ->handleRequest($request);

            if (!($this->formHandler->handle($form, $trick))) {
                return $this->responder->response(false, $form);
            }
        } else {
            $this->session->getFlashBag()->add(
                "danger",
                "Veuillez vous connecter avec d'effectuer cette action !"
            );
        }
        return $this->responder->response(true);
    }
}
