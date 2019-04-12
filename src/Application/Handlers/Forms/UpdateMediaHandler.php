<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\UpdateMediaHandlerInterface;
use App\Application\Helpers\SafeRenameHelper;
use App\Domain\DTO\UpdateImageMediaDTO;
use App\Domain\DTO\UpdateLinkMediaDTO;
use App\Domain\Models\Interfaces\MediaInterface;
use App\Domain\Models\Media;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UpdateMediaHandler implements UpdateMediaHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;

    private $tokenStorage;

    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        TokenStorageInterface $tokenStorage
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FormInterface $form
     * @param MediaInterface $media
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form, MediaInterface $media): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            switch (get_class($dto)) {
                case UpdateImageMediaDTO::class:
                    // UNIQUE FILENAME
                    $fileName = null;
                    if (!is_null($dto->image)) {
                        $fileName = SafeRenameHelper::uniqueFilename() . "." . $dto->image->guessExtension();

                        // SAVING IMAGE IN FOLDER
                        try {
                            $dto->image->move(
                                "images/downloaded/tricks/",
                                $fileName
                            );
                        } catch (FileException $e) {
                            $this->session->getFlashBag()->add(
                                "danger",
                                "Une erreur s'est produite lors de l'enregistrement d'image !"
                            );
                        }
                    }

                    // IF NEW = FIRST => UNFIRST OTHERS
                    if ($dto->first) {
                        $this->entityManager->getRepository(Media::class)
                            ->unsetFirstDb($media->getTrick());
                    }

                    $media->updateMediaWithImage($fileName, $dto->alt, $dto->first);
                    break;
                case UpdateLinkMediaDTO::class:
                    $media->updateMediaWithLink($dto->link, $dto->alt);
                    break;
                default:
                    $form = null;
                    $this->session->getFlashBag()->add(
                        "danger",
                        "Modification impossible : ce type de média n'existe pas !"
                    );
            }

            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Média modifié !");

            return true;
        }
        return false;
    }
}
