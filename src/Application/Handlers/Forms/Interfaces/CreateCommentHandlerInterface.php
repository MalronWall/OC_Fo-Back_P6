<?php
/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms\Interfaces;

use App\Domain\Models\Interfaces\TrickInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface CreateCommentHandlerInterface
{
    /**
     * CreateCommentHandlerInterface constructor.
     * @param EntityManagerInterface $entityManager
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session
    );

    /**
     * @param FormInterface $form
     * @param TrickInterface $trick
     * @return bool
     */
    public function handle(FormInterface $form, TrickInterface $trick): bool;
}