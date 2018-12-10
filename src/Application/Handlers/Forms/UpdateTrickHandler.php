<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\UpdateTrickHandlerInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UpdateTrickHandler implements UpdateTrickHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;

    /**
     * UpdateTrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SessionInterface $session
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     * @param TrickInterface $trick
     * @return bool
     */
    public function handle(FormInterface $form, TrickInterface $trick): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            $trick->updateTrick($dto);

            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Trick modifié !");

            return true;
        }
        return false;
    }
}
