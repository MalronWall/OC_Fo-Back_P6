<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Domain\Models\Trick;
use App\UI\Actions\Interfaces\TricksDeleteActionInterface;
use App\UI\Responders\Interfaces\TricksDeleteResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TricksDeleteAction implements TricksDeleteActionInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var TricksDeleteResponderInterface */
    private $responder;
    /** @var SessionInterface */
    private $session;

    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param TricksDeleteResponderInterface $responder
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TricksDeleteResponderInterface $responder,
        SessionInterface $session
    ) {
        $this->entityManager = $entityManager;
        $this->responder = $responder;
        $this->session = $session;
    }

    /**
     * @Route("/tricks/delete/{slug}", name="tricks_delete", requirements={"slug":".+"})
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($slug):Response
    {
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->getTrick($slug);

        if ($trick) {
            $this->entityManager->remove($trick);
            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Trick supprimé !");
        } else {
            $this->session->getFlashBag()->add("danger", "Suppression impossible : ce trick n'existe pas !");
        }

        return $this->responder->response();
    }
}
