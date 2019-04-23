<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Handlers\Forms\Interfaces\CreateCommentHandlerInterface;
use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

interface TricksDetailsActionInterface
{
    /**
     * TricksDetailsAction constructor.
     * @param TricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     * @param FormFactoryInterface $formFactory
     * @param CreateCommentHandlerInterface $formHandler
     * @param PaginatorHelperInterface $paginatorHelper
     */
    public function __construct(
        TricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager,
        Security $security,
        FormFactoryInterface $formFactory,
        CreateCommentHandlerInterface $formHandler,
        PaginatorHelperInterface $paginatorHelper
    );

    /**
     * @Route("/tricks/details/{slug}", name="tricks_details", requirements={"slug":".+"})
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function action(Request $request, $slug): Response;
}