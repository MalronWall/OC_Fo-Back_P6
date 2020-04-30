<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Application\Helpers\SafeRenameHelper;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Media;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UpdateTrickHandler implements UpdateTrickHandlerInterface
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
     * @param TrickInterface $trick
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form, TrickInterface $trick): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            $trick->updateTrick($user, $dto);

            // LINK
            $typeMediaVideo = $this->entityManager
                ->getRepository(TypeMedia::class)
                ->getType("video");
            foreach ($dto->links as $link) {
                $trick->addLink(new Media($link->link, $link->alt, $typeMediaVideo));
            }

            // IMAGE
            $typeMediaImage = $this->entityManager
                ->getRepository(TypeMedia::class)
                ->getType("image");
            $first = true;
            foreach ($dto->images as $image) {
                // UNIQUE FILENAME
                $fileName = SafeRenameHelper::uniqueFilename().".".$image->image->guessExtension();

                // SAVING IMAGE IN FOLDER
                try {
                    $image->image->move(
                        "images/downloaded/tricks/",
                        $fileName
                    );
                } catch (FileException $e) {
                    $this->session->getFlashBag()->add(
                        "danger",
                        "Une erreur s'est produite lors de l'enregistrement d'image !"
                    );
                }

                // CHECK ONLY ONE FIRST ELSE FALSE
                if ($image->first && $first) {
                    foreach ($trick->getImages() as $img) {
                        $img->unsetFirst();
                    }
                    $trick->addImage(new Media($fileName, $image->alt, $typeMediaImage, true));
                    $first = false;
                } else {
                    $trick->addImage(new Media($fileName, $image->alt, $typeMediaImage));
                }
            }

            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Trick modifié !");

            return true;
        }
        return false;
    }
}
