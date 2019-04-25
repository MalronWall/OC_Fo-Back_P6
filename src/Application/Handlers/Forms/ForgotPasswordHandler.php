<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\ForgotPasswordHandlerInterface;
use App\Domain\DTO\ForgotPasswordDTO;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ForgotPasswordHandler implements ForgotPasswordHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;
    /** @var TokenGeneratorInterface */
    private $tokenGenerator;

    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        TokenGeneratorInterface $tokenGenerator
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ForgotPasswordDTO $dto */
            $dto = $form->getData();

            /** @var User $user */
            $user = $this->entityManager
                ->getRepository(User::class)
                ->verifyUniqueEmail($dto->email);

            if (!is_null($user)) {
                $user->createTokenForgotPwdInformations($this->tokenGenerator->generateToken());

                $this->entityManager->flush();

                //TODO MAIL TO SEND
            }

            $this->session->getFlashBag()->add(
                "success",
                "Un email vient de vous être envoyé pour la récupération de votre mot de passe !"
            );

            return true;
        }
        return false;
    }
}
