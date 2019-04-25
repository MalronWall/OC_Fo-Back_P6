<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\UpdateMediaHandlerInterface;
use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\Application\Helpers\Interfaces\WhichMediaHelperInterface;
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
    /** @var WhichMediaHelperInterface */
    private $whichMediaHelper;

    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param Security $security
     * @param HydrateHelperInterface $hydrateDTOHelper
     * @param FormFactoryInterface $formFactory
     * @param UpdateMediaHandlerInterface $formHandler
     * @param MediasUpdateResponderInterface $responder
     * @param WhichMediaHelperInterface $whichMediaHelper
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        Security $security,
        HydrateHelperInterface $hydrateDTOHelper,
        FormFactoryInterface $formFactory,
        UpdateMediaHandlerInterface $formHandler,
        MediasUpdateResponderInterface $responder,
        WhichMediaHelperInterface $whichMediaHelper
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->security = $security;
        $this->hydrateDTOHelper = $hydrateDTOHelper;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->responder = $responder;
        $this->whichMediaHelper = $whichMediaHelper;
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
            $media = $this->entityManager
                ->getRepository(Media::class)
                ->getMedia($id);

            $dto = $this->hydrateDTOHelper->hydrateUpdateMediaDTO($media);

            $form = $this->formFactory
                ->create($this->whichMediaHelper->getMediaType($dto), $dto)
                ->handleRequest($request);

            if (!($this->formHandler->handle($form, $media))) {
                return $this->responder->response(false, null, $form, $media);
            }
            return $this->responder->response(true, $media->getTrick()->getSlug());
        } else {
            $this->session->getFlashBag()->add("danger", "Veuillez vous connecter avec d'effectuer cette action !");
        }
        return $this->responder->response(true);
    }
}
