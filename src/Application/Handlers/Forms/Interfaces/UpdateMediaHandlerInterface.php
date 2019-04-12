<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use App\Domain\Models\Interfaces\MediaInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface UpdateMediaHandlerInterface
{
    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        TokenStorageInterface $tokenStorage
    );

    /**
     * @param FormInterface $form
     * @param MediaInterface $media
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form, MediaInterface $media): bool;
}