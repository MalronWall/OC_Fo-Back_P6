<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksDetailsActionInterface;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksDetailsAction implements TricksDetailsActionInterface
{
    /** @var TricksDetailsResponderInterface */
    private $responder;
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * TricksDetailsAction constructor.
     * @param TricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        TricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/tricks/details/{slug}", name="tricks_details", requirements={"slug":".+"})
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($slug):Response
    {
        /** @var $trick Trick */
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->getTrick($slug);

        return $this->responder->response($trick);
    }
}
