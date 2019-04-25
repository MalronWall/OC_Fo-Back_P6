<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Interfaces\FigureGroupInterface;
use App\Validator\Constraints\UniqueTitleInDb;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueTitleInDb(
 *     message="Ce titre existe déjà !"
 * )
 */
class UpdateTrickDTO implements UpdateTrickDTOInterface
{
    /** @var null|UuidInterface */
    public $id;
    /** @var string
     * @Assert\NotBlank(
     *     message="Un titre est obligatoire !"
     * )
     * @Assert\Length(
     *     min="3",
     *     minMessage="Le titre doit contenir au moins 3 caractères !",
     *     max="255",
     *     maxMessage="Le titre ne peut pas contenir plus de 255 caractères !"
     * )
     */
    public $title;
    /** @var string
     * @Assert\NotBlank(
     *     message="Une description est obligatoire !"
     * )
     * @Assert\Length(
     *     min="10",
     *     minMessage="Le titre doit contenir au moins 10 caractères !"
     * )
     */
    public $description;
    /** @var FigureGroupInterface */
    public $figureGroup;
    /** @var ArrayCollection */
    public $links;
    /** @var ArrayCollection */
    public $images;

    /**
     * UpdateTrickDTO constructor.
     * @param null|UuidInterface $id
     * @param null|string $title
     * @param null|string $description
     * @param FigureGroupInterface $figureGroup
     */
    public function __construct(
        ?UuidInterface $id,
        ?string $title,
        ?string $description,
        ?FigureGroupInterface $figureGroup
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->figureGroup = $figureGroup;
        $this->links = new ArrayCollection();
        $this->images = new ArrayCollection();
    }
}
