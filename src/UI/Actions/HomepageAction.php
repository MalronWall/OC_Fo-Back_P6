<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

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

    /**
     * HomepageAction constructor.
     * @param HomepageResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        HomepageResponderInterface $responder,
        EntityManagerInterface $entityManager
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function action(): Response
    {
        $tricks = $this->entityManager
            ->getRepository(Trick::class)
            ->getTricks();

        $tricksWithImages = [];
        foreach ($tricks as $trick) {
            $tricksWithImages[] = $trick->getImages();
        }

        return $this->responder->response($tricksWithImages);
    }
}
