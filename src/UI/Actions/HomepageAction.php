<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\HomepageActionInterface;
use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageAction implements HomepageActionInterface
{
    /** @var HomepageResponderInterface */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var PaginatorHelperInterface */
    private $paginatorHelper;

    /**
     * HomepageAction constructor.
     * @param HomepageResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param PaginatorHelperInterface $paginatorHelper
     */
    public function __construct(
        HomepageResponderInterface $responder,
        EntityManagerInterface $entityManager,
        PaginatorHelperInterface $paginatorHelper
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->paginatorHelper = $paginatorHelper;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function action(): Response
    {
        $trickRepository = $this->entityManager
            ->getRepository(Trick::class);

        $nbPagesTot = $this->paginatorHelper->nbPagesTot($trickRepository);

        $tricks = $trickRepository->getTricksFrom();

        return $this->responder->response($tricks, $nbPagesTot);
    }
}
