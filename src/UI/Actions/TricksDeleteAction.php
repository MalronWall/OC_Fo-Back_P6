<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Domain\Models\Trick;
use App\Domain\Models\TypeMedia;
use App\UI\Actions\Interfaces\TricksDeleteActionInterface;
use App\UI\Responders\Interfaces\TricksDeleteResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TricksDeleteAction implements TricksDeleteActionInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var TricksDeleteResponderInterface */
    private $responder;
    /** @var SessionInterface */
    private $session;
    /** @var Security */
    private $security;

    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param TricksDeleteResponderInterface $responder
     * @param SessionInterface $session
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TricksDeleteResponderInterface $responder,
        SessionInterface $session,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->responder = $responder;
        $this->session = $session;
        $this->security = $security;
    }

    /**
     * @Route("/tricks/delete/{slug}", name="tricks_delete", requirements={"slug":".+"})
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($slug):Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            /** @var $trick Trick */
            $trick = $this->entityManager
                ->getRepository(Trick::class)
                ->getTrick($slug);

            if ($trick) {
                $typeMediaImage = $this->entityManager
                    ->getRepository(TypeMedia::class)
                    ->getType("image");
                $path = "images/downloaded/tricks/";
                foreach ($trick->getMedias() as $image) {
                    if ($image->getTypeMedia() == $typeMediaImage) {
                        /** var $image Image */
                        if (file_exists($path . $image->getLink())) {
                            unlink($path . $image->getLink());
                        }
                    }
                }
                $this->entityManager->remove($trick);
                $this->entityManager->flush();

                $this->session->getFlashBag()->add("success", "Trick supprimé !");
            } else {
                $this->session->getFlashBag()->add("danger", "Suppression impossible : ce trick n'existe pas !");
            }
        } else {
            $this->session->getFlashBag()->add("danger", "Veuillez vous connecter avec d'effectuer cette action !");
        }
        return $this->responder->response();
    }
}
