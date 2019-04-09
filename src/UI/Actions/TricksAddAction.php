<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\UI\Actions\Interfaces\TricksAddActionInterface;
use App\UI\Forms\CreateTrickType;
use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TricksAddAction implements TricksAddActionInterface
{
    /** @var TricksAddResponderInterface */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var CreateTrickHandlerInterface */
    private $formHandler;
    /** @var Security */
    private $security;
    /** @var SessionInterface */
    private $session;

    /**
     * TricksAddAction constructor.
     * @param TricksAddResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param CreateTrickHandlerInterface $formHandler
     * @param Security $security
     * @param SessionInterface $session
     */
    public function __construct(
        TricksAddResponderInterface $responder,
        FormFactoryInterface $formFactory,
        CreateTrickHandlerInterface $formHandler,
        Security $security,
        SessionInterface $session
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->security = $security;
        $this->session = $session;
    }

    /**
     * @Route(
     *     "/tricks/add/",
     *     name="tricks_add"
     * )
     * @param Request $request
     * @return mixed
     */
    public function action(Request $request):Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $form = $this->formFactory
                ->create(CreateTrickType::class)
                ->handleRequest($request);

            if (!($this->formHandler->handle($form))) {
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
