<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\ForgotPasswordDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ForgotPasswordDTO implements ForgotPasswordDTOInterface
{
    /** @var string
     * @Assert\NotBlank(
     *     message="L'email est obligatoire !"
     * )
     * @Assert\Email(
     *     message="Merci de renseigner un email valide !"
     * )
     */
    public $email;

    /**
     * RegistrationDTO constructor.
     * @param null|string $email
     */
    public function __construct(
        ?string $email
    ) {
        $this->email = $email;
    }
}
