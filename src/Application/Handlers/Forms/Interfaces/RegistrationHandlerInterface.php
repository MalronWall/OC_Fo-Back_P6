<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface RegistrationHandlerInterface
{
    /**
     * RegistrationHandlerInterface constructor.
     * @param EntityManagerInterface $entityManager
     * @param EncoderFactoryInterface $passwordEncoder
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $passwordEncoder,
        SessionInterface $session
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
