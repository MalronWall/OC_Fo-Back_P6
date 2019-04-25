<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\Domain\Models\Trick;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class TricksDetailsResponder implements TricksDetailsResponderInterface
{
    /** @var Environment */
    private $templating;
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * TricksDetailsResponder constructor.
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
     * @param $isRedirect
     * @param Trick $trick
     * @param $comments
     * @param FormInterface|null $form
     * @param $nbPagesTot
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(
        $isRedirect,
        Trick $trick,
        $comments = null,
        FormInterface $form = null,
        $nbPagesTot = null
    ): Response {
        $response = $isRedirect ?
            new RedirectResponse(
                $this->urlGenerator->generate("tricks_details", [
                    "slug" => $trick->getSlug()
                ])
            )
        :
                new Response(
                    $this->templating->render(
                        'tricks_details.html.twig',
                        [
                            "trick" => $trick,
                            "comments" => $comments,
                            "form" => !is_null($form) ? $form->createView() : null,
                            "nbPagesTot" => $nbPagesTot
                        ]
                    )
                );

        return $response;
    }
}
