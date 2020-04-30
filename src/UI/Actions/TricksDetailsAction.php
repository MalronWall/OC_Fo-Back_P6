<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Handlers\Forms\Interfaces\CreateCommentHandlerInterface;
use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksDetailsActionInterface;
use App\UI\Forms\CreateCommentType;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    /** @var PaginatorHelperInterface */
    private $paginatorHelper;
    /** @var SessionInterface */
    private $session;

    /**
     * TricksDetailsAction constructor.
     * @param TricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     * @param FormFactoryInterface $formFactory
     * @param CreateCommentHandlerInterface $formHandler
     * @param PaginatorHelperInterface $paginatorHelper
     * @param SessionInterface $session
     */
    public function __construct(
        TricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager,
        Security $security,
        FormFactoryInterface $formFactory,
        CreateCommentHandlerInterface $formHandler,
        PaginatorHelperInterface $paginatorHelper,
        SessionInterface $session
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
        $this->paginatorHelper = $paginatorHelper;
        $this->session = $session;
    }

    /**
     * @Route("/tricks/details/{slug}", name="tricks_details", requirements={"slug":".+"})
     * @param Request $request
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action(Request $request, $slug):Response
    {
        /** @var Trick $trick */
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->getTrick($slug);

        if (!is_null($trick)) {
            $commentRepository = $this->entityManager
                ->getRepository(Comment::class);

            $nbPagesTot = $this->paginatorHelper->nbPagesTot($commentRepository, $trick->getSlug());

            // Comments + the created one
            $comments = $commentRepository->getCommentsFrom($trick->getSlug());
            if ($this->security->isGranted('ROLE_USER')) {
                $form = $this->formFactory
                    ->create(CreateCommentType::class)
                    ->handleRequest($request);

                if ($this->formHandler->handle($form, $trick)) {
                    return $this->responder->response(true, $trick);
                }
                return $this->responder->response(false, $trick, $comments, $form, $nbPagesTot);
            }
            return $this->responder->response(false, $trick, $comments, null, $nbPagesTot);
        }
        $this->session->getFlashBag()->add(
            "danger",
            "Aucun trick ne possède cette url : \"".$slug."\" !"
        );

        return $this->responder->response(true);
    }
}
