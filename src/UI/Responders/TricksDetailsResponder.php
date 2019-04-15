<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class TricksDetailsResponder implements TricksDetailsResponderInterface
{
    /** @var Environment */
    private $templating;

    /**
     * TricksDetailsResponder constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @param $trick
     * @param $comments
     * @param FormInterface|null $form
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response($trick, $comments, FormInterface $form = null): Response
    {
        return new Response(
            $this->templating->render(
                'tricks_details.html.twig',
                [
                    "trick" => $trick,
                    "comments" => $comments,
                    "form" => $form->createView()
                ]
            )
        );
    }
}
