<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\CreateCommentHandlerInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreateCommentHandler implements CreateCommentHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** @var SessionInterface */
    private $session;

    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session
    ) {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->session = $session;
    }

    public function handle(FormInterface $form, TrickInterface $trick): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            $comment = new Comment($user, $dto->comment, $trick);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Commentaire créé !");

            return true;
        }
        return false;
    }
}
