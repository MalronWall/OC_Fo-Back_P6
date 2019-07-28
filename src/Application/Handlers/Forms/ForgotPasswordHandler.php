<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\ForgotPasswordHandlerInterface;
use App\Application\Helpers\Interfaces\MailerHelperInterface;
use App\Application\Helpers\MailerHelper;
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
    /** @var MailerHelperInterface */
    private $mailerHelper;

    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param TokenGeneratorInterface $tokenGenerator
     * @param MailerHelperInterface $mailerHelper
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        TokenGeneratorInterface $tokenGenerator,
        MailerHelperInterface $mailerHelper
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->tokenGenerator = $tokenGenerator;
        $this->mailerHelper = $mailerHelper;
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

                //TODO MAIL DOES NOT WORK
                $this->mailerHelper->sendEmail(
                    "Forgot password",
                    "tests.prod.tourtet@gmail.com",
                    $user->getEmail(),
                    $user
                );
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
