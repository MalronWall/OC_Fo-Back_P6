<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\AjaxHomepageActionInterface;
use App\UI\Responders\Interfaces\AjaxHomepageResponderInterface;
use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxHomepageAction implements AjaxHomepageActionInterface
{
    /** @var HomepageResponderInterface */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var PaginatorHelperInterface */
    private $paginatorHelper;

    /**
     * HomepageAction constructor.
     * @param AjaxHomepageResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param PaginatorHelperInterface $paginatorHelper
     */
    public function __construct(
        AjaxHomepageResponderInterface $responder,
        EntityManagerInterface $entityManager,
        PaginatorHelperInterface $paginatorHelper
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->paginatorHelper = $paginatorHelper;
    }

    /**
     * @Route("/ajax-load-tricks/{numPage}", name="ajax-homepage", requirements={"numPage":"\d+"})
     * @param int $numPage
     * @return Response
     */
    public function action(int $numPage): Response
    {
        $trickRepository = $this->entityManager
                                ->getRepository(Trick::class);

        $nbPagesTot = $this->paginatorHelper->nbPagesTot($trickRepository, null, $numPage);

        if (is_null($nbPagesTot)) {
            return $this->responder->response();
        }

        $tricks = $trickRepository->getTricksFrom($numPage);

        return $this->responder->response($tricks);
    }
}
