<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\UpdateMediaHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\Domain\DTO\UpdateImageMediaDTO;
use App\Domain\DTO\UpdateLinkMediaDTO;
use App\Domain\Models\Media;
use App\UI\Forms\UpdateImageMediaType;
use App\UI\Forms\UpdateLinkMediaType;
use App\UI\Responders\Interfaces\MediasUpdateResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MediasTricksUpdateAction
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var MediasUpdateResponderInterface */
    private $responder;
    /** @var SessionInterface */
    private $session;
    /** @var Security */
    private $security;
    /** @var HydrateHelperInterface */
    private $hydrateDTOHelper;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var UpdateMediaHandlerInterface */
    private $formHandler;

    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param Security $security
     * @param HydrateHelperInterface $hydrateDTOHelper
     * @param FormFactoryInterface $formFactory
     * @param UpdateMediaHandlerInterface $formHandler
     * @param MediasUpdateResponderInterface $responder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        Security $security,
        HydrateHelperInterface $hydrateDTOHelper,
        FormFactoryInterface $formFactory,
        UpdateMediaHandlerInterface $formHandler,
        MediasUpdateResponderInterface $responder
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->security = $security;
        $this->hydrateDTOHelper = $hydrateDTOHelper;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->responder = $responder;
    }

    /**
     * @Route("/medias/update/{id}", name="medias_update", requirements={"id":".+"})
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action(Request $request, $id):Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            /** @var Media $media */
            $media = $this->entityManager
                ->getRepository(Media::class)
                ->getMedia($id);

            $dto = $this->hydrateDTOHelper->hydrateUpdateMediaDTO($media);

            switch (get_class($dto)) {
                case UpdateImageMediaDTO::class:
                    $form = $this->formFactory
                        ->create(UpdateImageMediaType::class, $dto)
                        ->handleRequest($request);
                    break;
                case UpdateLinkMediaDTO::class:
                    $form = $this->formFactory
                        ->create(UpdateLinkMediaType::class, $dto)
                        ->handleRequest($request);
                    break;
                default:
                    $form = null;
                    $this->session->getFlashBag()->add(
                        "danger",
                        "Modification impossible : ce type de média n'existe pas !"
                    );
            }

            if (!($this->formHandler->handle($form, $media))) {
                return $this->responder->response(false, null, $form, $media);
            }
            return $this->responder->response(true, $media->getTrick()->getSlug());
        } else {
            $this->session->getFlashBag()->add(
                "danger",
                "Veuillez vous connecter avec d'effectuer cette action !"
            );
        }
        return $this->responder->response(true);
    }
}
