<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Validator\Constraints\UniqueTitleInDb;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueTitleInDb(
 *     message="Ce titre existe déjà !"
 * )
 */
class UpdateTrickDTO implements UpdateTrickDTOInterface
{
    /** @var null|string */
    public $id;
    /** @var string
     * @Assert\NotBlank(
     *     message="Le titre est obligatoire !"
     * )
     * @Assert\Length(
     *     min="3",
     *     minMessage="Le titre doit contenir au moins 3 caractères !",
     *     max="255",
     *     maxMessage="Le titre ne peut pas contenir plus de 255 caractères !"
     * )
     */
    public $title;
    /** @var string */
    public $description;
    /** @var string
    * @Assert\Length(
    *     max="255",
    *     maxMessage="Le groupe ne peut pas contenir plus de 255 caractères !"
    * )
    */
    public $figureGroup;

    /**
     * UpdateTrickDTO constructor.
     * @param null|string $title
     * @param null|string $description
     * @param null|string $figureGroup
     * @param null|UuidInterface $id
     */
    public function __construct(
        ?string $title,
        ?string $description,
        ?string $figureGroup,
        ?UuidInterface $id = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->figureGroup = $figureGroup;
        $this->id = $id;
    }
}
