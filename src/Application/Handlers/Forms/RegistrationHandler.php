<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\RegistrationHandlerInterface;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class RegistrationHandler implements RegistrationHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * RegistrationHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();
            $user = new User($dto->username, $dto->email, $dto->password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }
        return false;
    }
}
