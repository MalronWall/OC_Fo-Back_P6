<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository\Interfaces;

use Doctrine\ORM\NonUniqueResultException;

interface UserRepositoryInterface
{

    /**
     * @param $token
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkTokenForgotPwd($token);

    /**
     * @param $token
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkTokenDateForgotPwd($token);

    /**
     * @param $pseudo
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function verifyUniqueUser($pseudo);

    /**
     * @param $email
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function verifyUniqueEmail($email);
}
