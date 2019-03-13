<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Application\Helpers\Interfaces\HydrateHelperInterface;
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
    /** @var HydrateHelperInterface */
    private $hydrateDTOHelper;

    /**
     * HomepageAction constructor.
     * @param HomepageResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param HydrateHelperInterface $hydrateDTOHelper
     */
    public function __construct(
        HomepageResponderInterface $responder,
        EntityManagerInterface $entityManager,
        HydrateHelperInterface $hydrateDTOHelper
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->hydrateDTOHelper = $hydrateDTOHelper;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function action(): Response
    {
        $tricks = $this->entityManager
            ->getRepository(Trick::class)
            ->getTricks();

        dump($tricks);exit;

        $tricksWithImages = [];
        foreach ($tricks as $trick) {
            $tricksWithImages[] = $this->hydrateDTOHelper->hydrateTrick($trick);
        }
        dump($tricks);exit;

        return $this->responder->response();
    }
}
