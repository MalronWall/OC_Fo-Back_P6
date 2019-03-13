<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\Application\Helpers\Interfaces\HydrateHelperInterface;
use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

interface HomepageActionInterface
{
    /**
     * HomepageActionInterface constructor.
     * @param HomepageResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param HydrateHelperInterface $hydrateDTOHelper
     */
    public function __construct(
        HomepageResponderInterface $responder,
        EntityManagerInterface $entityManager,
        HydrateHelperInterface $hydrateDTOHelper
    );

    /**
     * @return Response
     */
    public function action(): Response;
}
