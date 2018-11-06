<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\RegistrationDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationDTO implements RegistrationDTOInterface
{
    /** @var string
     * @Assert\NotBlank(
     *     message="Le pseudo est obligatoire !"
     * )
     * @Assert\Length(
     *     min="3",
     *     minMessage="Le pseudo doit contenir au moins 3 caractères !",
     *     max="20",
     *     maxMessage="Le pseudo ne peut pas contenir plus de 20 caractères !"
     * )
     */
    public $username;
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
     * @param null|string $username
     * @param null|string $email
     * @param null|string $password
     */
    public function __construct(
        ?string $username,
        ?string $email,
        ?string $password
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
