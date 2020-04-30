<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

interface ResetPasswordHandlerInterface
{
    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param TokenGeneratorInterface $tokenGenerator
     * @param EncoderFactoryInterface $passwordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        TokenGeneratorInterface $tokenGenerator,
        EncoderFactoryInterface $passwordEncoder
    );

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function handle(FormInterface $form, User $user): bool;
}