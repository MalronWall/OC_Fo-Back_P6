<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\CreateTrickDTOInterface;
use App\Domain\Models\Interfaces\FigureGroupInterface;
use App\Validator\Constraints\UniqueTitleInDb;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueTitleInDb(
 *     message="Ce titre existe déjà !"
 * )
 */
class CreateTrickDTO implements CreateTrickDTOInterface
{
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
    /**
     * @var array|null
     *
     * @Assert\Valid()
     */
    public $links;
    /**
     * @var array|null
     *
     * @Assert\Valid()
     */
    public $images;

    /**
     * CreateTrickDTO constructor.
     * @param null|string $title
     * @param null|string $description
     * @param FigureGroupInterface|null $figureGroup
     * @param array|null $links
     * @param array|null $images
     */
    public function __construct(
        ?string $title,
        ?string $description,
        ?FigureGroupInterface $figureGroup,
        ?array $links,
        ?array $images
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->figureGroup = $figureGroup;
        $this->links = $links;
        $this->images = $images;
    }
}
