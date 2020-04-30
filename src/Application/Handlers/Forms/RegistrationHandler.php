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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegistrationHandler implements RegistrationHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var EncoderFactoryInterface */
    private $passwordEncoder;
    /** @var SessionInterface */
    private $session;

    /**
     * RegistrationHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param EncoderFactoryInterface $passwordEncoder
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $passwordEncoder,
        SessionInterface $session
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            $pwdEncoder = $this->passwordEncoder->getEncoder(User::class);
            $pwdEncoded = $pwdEncoder->encodePassword($dto->password, '');

            $user = new User($dto->username, $dto->email, $pwdEncoded);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Inscription réussie !");

            return true;
        }
        return false;
    }
}
