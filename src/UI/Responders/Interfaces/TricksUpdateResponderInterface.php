<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders\Interfaces;

use App\Domain\Models\Trick;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface TricksUpdateResponderInterface
{
    /**
     * TricksUpdateResponderInterface constructor.
     * @param Environment $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $templating,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param bool $isRedirect
     * @param FormInterface|null $form
     * @param Trick|null $trick
     * @return Response
     */
    public function response(bool $isRedirect, FormInterface $form = null, Trick $trick = null): Response;
}
