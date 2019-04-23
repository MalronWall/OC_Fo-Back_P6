<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Helpers\Interfaces\PaginatorHelperInterface;
use App\UI\Responders\Interfaces\AjaxHomepageResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

interface AjaxHomepageActionInterface
{
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
    );

    /**
     * @Route("/ajax-load-tricks/{numPage}", name="ajax-homepage", requirements={"numPage":"\d+"})
     * @param $numPage
     * @return Response
     */
    public function action(int $numPage): Response;
}