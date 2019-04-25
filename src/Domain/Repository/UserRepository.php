<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkTokenForgotPwd($token)
    {
        return $this->createQueryBuilder('u')
            ->where('u.tokenForgotPwd = :token')
            ->setParameter('token', $token)

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function checkTokenDateForgotPwd($token)
    {
        return $this->createQueryBuilder('u')
            ->where('u.tokenForgotPwd = :token')
            ->setParameter('token', $token)

            ->andWhere('u.tokenDateForgotPwd > :now')
            ->setParameter('now', new \DateTime())

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function verifyUniqueUser($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')

            ->setParameter('username', $username)

            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function verifyUniqueEmail($email)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')

            ->setParameter('email', $email)

            ->getQuery()
            ->getOneOrNullResult();
    }
}
