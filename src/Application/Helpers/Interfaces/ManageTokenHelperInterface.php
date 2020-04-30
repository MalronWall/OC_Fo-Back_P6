<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface ManageTokenHelperInterface
{
    /**
     * ManageTokenHelper constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session);

    /**
     * @param $token
     * @return mixed|string
     */
    public function checkTokenIsValid($token);
}
