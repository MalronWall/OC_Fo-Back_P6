<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Forms\Interfaces\CreateTrickHandlerInterface;
use App\Domain\Models\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateTrickHandler implements CreateTrickHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SessionInterface */
    private $session;

    /**
     * RegistrationHandler constructor.
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
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $dto = $form->getData();

            $trick = new Trick($dto->title, $dto->description, $dto->figureGroup);

            $this->entityManager->persist($trick);
            $this->entityManager->flush();

            $this->session->getFlashBag()->add("success", "Trick créé !");

            return true;
        }
        return false;
    }
}
