<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class TricksAddResponder implements TricksAddResponderInterface
{
    /** @var Environment */
    private $templating;
    /** @var */
    private $urlGenerator;

    /**
     * TricksAddResponder constructor.
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
     * @param FormInterface|null $form
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(bool $isRedirect, FormInterface $form = null): Response
    {
        return $isRedirect ?
            new RedirectResponse(
                $this->urlGenerator->generate('homepage')
            ):
            new Response(
                $this->templating->render(
                    'tricks_add.html.twig',
                    [
                        'form' => $form->createView()
                    ]
                )
            );
    }
}
