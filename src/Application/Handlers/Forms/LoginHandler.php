<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\LoginHandlerInterface;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class LoginHandler implements LoginHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * LoginHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();
            /*
            $user = new User($dto->username, $dto->email, $dto->password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            */

            $this->entityManager->getRepository(User::class)->loadUserByEmail(MES_PARAMETRES);

            // $repository = $this->getDoctrine->getRepository(UserRepository::class);

            return true;
        }
        return false;
    }
}
