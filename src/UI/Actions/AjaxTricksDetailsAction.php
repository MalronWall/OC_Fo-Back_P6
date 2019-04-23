<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\AjaxHomepageActionInterface;
use App\UI\Responders\Interfaces\AjaxHomepageResponderInterface;
use App\UI\Responders\Interfaces\AjaxTricksDetailsResponderInterface;
use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxTricksDetailsAction
{
    /** @var HomepageResponderInterface */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var PaginatorHelperInterface */
    private $paginatorHelper;

    /**
     * HomepageAction constructor.
     * @param AjaxTricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param PaginatorHelperInterface $paginatorHelper
     */
    public function __construct(
        AjaxTricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager,
        PaginatorHelperInterface $paginatorHelper
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->paginatorHelper = $paginatorHelper;
    }

    /**
     * @Route("/ajax-load-comments/{numPage}", name="ajax-tricks-details", requirements={"numPage":"\d+"})
     * @param int $numPage
     * @return Response
     */
    public function action(int $numPage): Response
    {
        $commentRepository = $this->entityManager
            ->getRepository(Comment::class);

        $nbPagesTot = $this->paginatorHelper->nbPagesTot($commentRepository, $numPage);

        if (is_null($nbPagesTot)) {
            return $this->responder->response();
        }

        $tricks = $commentRepository->getCommentsFrom($numPage);

        return $this->responder->response($tricks);
    }
}
