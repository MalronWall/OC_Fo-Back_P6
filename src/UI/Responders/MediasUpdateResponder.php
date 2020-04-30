<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\Domain\Models\Media;
use App\UI\Responders\Interfaces\MediasUpdateResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class MediasUpdateResponder implements MediasUpdateResponderInterface
{
    /** @var Environment */
    private $templating;
    /** @var */
    private $urlGenerator;

    /**
     * TricksUpdateResponder constructor.
     * @param Environment $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $templating,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->templating = $templating;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param bool $isRedirect
     * @param null $slug
     * @param FormInterface|null $form
     * @param Media|null $media
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(bool $isRedirect, $slug = null, FormInterface $form = null, Media $media = null): Response
    {
        return $isRedirect ?
            !$slug ?
                new RedirectResponse(
                    $this->urlGenerator->generate('homepage')
                ):
                new RedirectResponse(
                    $this->urlGenerator->generate('tricks_update', array('slug' => $slug))
                )
            :
            new Response(
                $this->templating->render(
                    'medias_update.html.twig',
                    [
                        'form' => $form->createView(),
                        'media' => $media
                    ]
                )
            );
    }
}
