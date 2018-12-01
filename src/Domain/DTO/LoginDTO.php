<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\LoginDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO implements LoginDTOInterface
{
    /** @var string
     * @Assert\NotBlank(
     *     message="L'email est obligatoire !"
     * )
     */
    public $email;
    /** @var string
     * @Assert\NotBlank(
     *     message="Le mot de passe est obligatoire !"
     * )
     * @Assert\Length(
     *     min="6",
     *     minMessage="Le mot de passe doit contenir au moins 6 caractères !"
     * )
     */
    public $password;

    /**
     * RegistrationDTO constructor.
     * @param null|string $email
     * @param null|string $password
     */
    public function __construct(
        ?string $email,
        ?string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}
