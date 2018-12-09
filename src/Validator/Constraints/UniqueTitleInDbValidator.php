<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Validator\Constraints;

use App\Domain\Models\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueTitleInDbValidator extends ConstraintValidator
{

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * UniqueTitleInDbValidator constructor.
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
     * @throws \Doctrine\DBAL\DBALException
     */
    public function validate($protocol, Constraint $constraint)
    {
        if (isset($protocol->id)) {
            $nbTrick =
                $this->entityManager
                    ->getRepository(Trick::class)
                    ->verifyUniqueTitle($protocol->title, $protocol->id);
        } else {
            $nbTrick =
                $this->entityManager
                    ->getRepository(Trick::class)
                    ->verifyUniqueTitle($protocol->title);
        }

        if ($nbTrick) {
            $this->context->buildViolation($constraint->message)
                ->atPath('title')
                ->addViolation();
        }
    }
}
