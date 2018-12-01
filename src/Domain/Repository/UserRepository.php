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
