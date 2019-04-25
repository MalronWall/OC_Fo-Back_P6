<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\MediasTricksDeleteResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

interface MediasTricksDeleteActionInterface
{
    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param MediasTricksDeleteResponderInterface $responder
     * @param SessionInterface $session
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MediasTricksDeleteResponderInterface $responder,
        SessionInterface $session,
        Security $security
    );

    /**
     * @Route("/medias/delete/{id}", name="medias_delete", requirements={"id":".+"})
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($id): Response;
}