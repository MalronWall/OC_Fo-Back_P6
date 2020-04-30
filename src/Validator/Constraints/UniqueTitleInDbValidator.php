<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Validator\Constraints;

use App\Application\Helpers\SafeRenameHelper;
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
     * @param $value
     * @param Constraint $constraint The constraint for the validation
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function validate($value, Constraint $constraint)
    {
        if (isset($value->id)) {
            $nbTrick =
                $this->entityManager
                    ->getRepository(Trick::class)
                    ->verifyUniqueTitle(SafeRenameHelper::slug($value->title), $value->id);
        } else {
            $nbTrick =
                $this->entityManager
                    ->getRepository(Trick::class)
                    ->verifyUniqueTitle(SafeRenameHelper::slug($value->title));
        }

        if ($nbTrick) {
            $this->context->buildViolation($constraint->message)
                ->atPath('title')
                ->addViolation();
        }
    }
}
