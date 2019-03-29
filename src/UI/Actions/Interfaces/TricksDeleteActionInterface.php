<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\TricksDeleteResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

interface TricksDeleteActionInterface
{
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
    );

    /**
     * @Route("/tricks/delete/{slug}", name="tricks_delete", requirements={"slug":".+"})
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($slug): Response;
}