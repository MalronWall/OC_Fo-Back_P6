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
use Symfony\Component\Routing\Annotation\Route;

class TricksAddAction implements TricksAddActionInterface
{
    /** @var TricksAddResponderInterface */
    private $responder;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var CreateTrickHandlerInterface */
    private $formHandler;

    /**
     * TricksAddAction constructor.
     * @param TricksAddResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param CreateTrickHandlerInterface $formHandler
     */
    public function __construct(
        TricksAddResponderInterface $responder,
        FormFactoryInterface $formFactory,
        CreateTrickHandlerInterface $formHandler
    ) {
        $this->responder = $responder;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }

    /**
     * @Route("/tricks/add/", name="tricks_add")
     * @param Request $request
     * @return mixed
     */
    public function action(Request $request):Response
    {
        $form = $this->formFactory
            ->create(CreateTrickType::class)
            ->handleRequest($request);
        if ($this->formHandler->handle($form)) {
            return $this->responder->response(true);
        }
        return $this->responder->response(false, $form);
    }
}
