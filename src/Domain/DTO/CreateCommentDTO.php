<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\CreateCommentDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCommentDTO implements CreateCommentDTOInterface
{
    /** @var string
     * @Assert\NotBlank(
     *     message="Du texte est obligatoire !"
     * )
     */
    public $comment;

    /**
     * CreateCommentDTO constructor.
     * @param null|string $comment
     */
    public function __construct(?string $comment)
    {
        $this->comment = $comment;
    }
}
