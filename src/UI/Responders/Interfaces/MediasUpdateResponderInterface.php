<?php
/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders\Interfaces;

use App\Domain\Models\Media;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface MediasUpdateResponderInterface
{
    /**
     * TricksUpdateResponder constructor.
     * @param Environment $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $templating, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $isRedirect
     * @param null $slug
     * @param FormInterface|null $form
     * @param Media|null $media
     * @return Response
     */
    public function response(bool $isRedirect, $slug = null, FormInterface $form = null, Media $media = null): Response;
}