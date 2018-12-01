<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Validator\Constraints;

use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailInDbValidator extends ConstraintValidator
{

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * UniqueEmailInDbValidator constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * Checks if the passed value is valid.
     * @param $protocol
     * @param Constraint $constraint The constraint for the validation
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function validate($protocol, Constraint $constraint)
    {
        $nbUser =
            $this->entityManager
                ->getRepository(User::class)
                ->verifyUniqueEmail($protocol->email);

        if ($nbUser) {
            $this->context->buildViolation($constraint->message)
                ->atPath('email')
                ->addViolation();
        }
    }
}
