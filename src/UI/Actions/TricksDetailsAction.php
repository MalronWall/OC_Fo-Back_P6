<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\CreateCommentHandlerInterface;
use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksDetailsActionInterface;
use App\UI\Forms\CreateCommentType;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TricksDetailsAction implements TricksDetailsActionInterface
{
    /** @var TricksDetailsResponderInterface */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var Security */
    private $security;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var CreateTrickHandlerInterface */
    private $formHandler;

    /**
     * TricksDetailsAction constructor.
     * @param TricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     * @param FormFactoryInterface $formFactory
     * @param CreateCommentHandlerInterface $formHandler
     */
    public function __construct(
        TricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager,
        Security $security,
        FormFactoryInterface $formFactory,
        CreateCommentHandlerInterface $formHandler
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }

    /**
     * @Route("/tricks/details/{slug}", name="tricks_details", requirements={"slug":".+"})
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function action(Request $request, $slug):Response
    {
        /** @var Trick $trick */
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->getTrick($slug);

        if ($this->security->isGranted('ROLE_USER')) {
            $form = $this->formFactory
                ->create(CreateCommentType::class)
                ->handleRequest($request);

            $this->formHandler->handle($form, $trick);

            $form = $this->formFactory
                ->create(CreateCommentType::class);

            // Comments + the created one
            $comments = $this->entityManager
                ->getRepository(Comment::class)
                ->getComments($trick);

            return $this->responder->response($trick, $comments, $form);
        }

        // Comments existing
        $comments = $this->entityManager
            ->getRepository(Comment::class)
            ->getComments($trick);

        return $this->responder->response($trick, $comments);
    }
}
