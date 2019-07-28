<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\Domain\Models\Media;
use App\UI\Actions\Interfaces\MediasTricksDeleteActionInterface;
use App\UI\Responders\Interfaces\MediasTricksDeleteResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MediasTricksDeleteAction implements MediasTricksDeleteActionInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var MediasTricksDeleteResponderInterface */
    private $responder;
    /** @var SessionInterface */
    private $session;
    /** @var Security */
    private $security;

    /**
     * TricksDeleteAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param MediasTricksDeleteResponderInterface $responder
     * @param SessionInterface $session
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MediasTricksDeleteResponderInterface $responder,
        SessionInterface $session,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->responder = $responder;
        $this->session = $session;
        $this->security = $security;
    }

    /**
     * @Route("/medias/delete/{id}", name="medias_delete", requirements={"id":".+"})
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function action($id):Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            /** @var Media $media */
            $media = $this->entityManager
                ->getRepository(Media::class)
                ->getMedia($id);

            if ($media) {
                unlink("images/downloaded/tricks/" . $media->getLink());

                $this->entityManager->remove($media);
                $this->entityManager->flush();

                $this->session->getFlashBag()->add(
                    "success",
                    "Média supprimé !"
                );

                return $this->responder->response($media->getTrick()->getSlug());
            } else {
                $this->session->getFlashBag()->add(
                    "danger",
                    "Suppression impossible : ce média n'existe pas !"
                );
            }
        } else {
            $this->session->getFlashBag()->add(
                "danger",
                "Veuillez vous connecter avec d'effectuer cette action !"
            );
        }
<<<<<<< HEAD
        return $this->responder->response();
=======
        $trickMedia = $media->getTypeMedia() == "image" ? $media->getTrickImage() : $media->getTrickLink();
        return $this->responder->response($trickMedia->getSlug());
>>>>>>> [UPD] mapping errors fix with trickImage, trickLink and comments / new config mail to test on the server
    }
}
