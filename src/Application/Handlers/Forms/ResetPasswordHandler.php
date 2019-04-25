<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\ForgotPasswordHandlerInterface;
use App\Application\Handlers\Forms\Interfaces\ResetPasswordHandlerInterface;
use App\Domain\DTO\ForgotPasswordDTO;
use App\Domain\DTO\ResetPasswordDTO;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ResetPasswordHandler implements ResetPasswordHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;
    /** @var TokenGeneratorInterface */
    private $tokenGenerator;
    /** @var EncoderFactoryInterface */
    private $passwordEncoder;

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
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->tokenGenerator = $tokenGenerator;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function handle(FormInterface $form, User $user): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ResetPasswordDTO $dto */
            $dto = $form->getData();

            if ($user->getEmail() === $dto->email) {
                $pwdEncoder = $this->passwordEncoder->getEncoder(User::class);
                $pwdEncoded = $pwdEncoder->encodePassword($dto->password, '');

                $user->resetPwd($pwdEncoded);

                $this->entityManager->flush();

                $this->session->getFlashBag()->add(
                    "success",
                    "Le mot de passe a été modifié avec succès !"
                );

                return true;
            } else {
                $this->session->getFlashBag()->add(
                    "danger",
                    "L'email entré ne correspond pas à la demande de réinitialisation !"
                );
            }
        }
        return false;
    }
}
