<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use App\Domain\Models\Interfaces\TrickInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface UpdateTrickHandlerInterface
{
    /**
     * RegistrationHandlerInterface constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session
    );

    /**
     * @param FormInterface $form
     * @param TrickInterface $trick
     * @return bool
     */
    public function handle(FormInterface $form, TrickInterface $trick): bool;
}
