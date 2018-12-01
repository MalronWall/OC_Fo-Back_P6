<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

interface LoginHandlerInterface
{
    /**
     * LoginHandlerInterface constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
