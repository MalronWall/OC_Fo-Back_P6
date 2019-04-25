<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\ManageTokenHelperInterface;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ManageTokenHelper implements ManageTokenHelperInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;

    /**
     * ManageTokenHelper constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * @param $token
     * @return mixed|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkTokenIsValid($token)
    {
        $userRepository = $this->entityManager
            ->getRepository(User::class);

        $user = null;
        if (!is_null($userRepository->checkTokenForgotPwd($token))) {
            if (!is_null($user = $userRepository->checkTokenDateForgotPwd($token))) {
                return $user;
            } else {
                $this->session->getFlashBag()->add(
                    "warning",
                    "La demande de réinitialisation de mot de passe est arrivée à son terme ! 
                    Veuillez renouveler la demande !"
                );
            }
        } else {
            $this->session->getFlashBag()->add(
                "warning",
                "La demande de réinitialisation de mot de passe ne peut aboutir ! 
                Le lien entré n'a pas de correspondance !"
            );
        }

        return $user;
    }
}
