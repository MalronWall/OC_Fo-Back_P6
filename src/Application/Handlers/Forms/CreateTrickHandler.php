<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Application\Helpers\SafeRenameHelper;
use App\Domain\Models\Media;
use App\Domain\Models\Trick;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateTrickHandler implements CreateTrickHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /**
     * RegistrationHandler constructor.
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
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            $trick = new Trick($user, $dto->title, $dto->description, $dto->figureGroup);

            // LINK
            $typeMediaVideo = $this->entityManager
                ->getRepository(TypeMedia::class)
                ->getType("video");
            foreach ($dto->links as $link) {
                $trick->addLink(new Media($link->link, $typeMediaVideo));
            }

            // IMAGE
            $typeMediaImage = $this->entityManager
                ->getRepository(TypeMedia::class)
                ->getType("image");
            $first = true;
            foreach ($dto->images as $image) {
                // UNIQUE FILENAME
                $fileName = SafeRenameHelper::uniqueFilename().".".$image->image->guessExtension();
                if ($first) {
                    $fileName = "first_".$fileName;
                    $first = false;
                }

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
                $trick->addImage(new Media($fileName, $typeMediaImage));
            }

            $this->entityManager->persist($trick);
            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Trick créé !");

            return true;
        }
        return false;
    }
}
