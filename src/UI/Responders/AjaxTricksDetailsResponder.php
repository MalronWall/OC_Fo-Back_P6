<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\AjaxTricksDetailsResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AjaxTricksDetailsResponder implements AjaxTricksDetailsResponderInterface
{
    /** @var Environment */
    private $templating;

    /**
     * HomepageResponder constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @param array $comments
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(array $comments = []): Response
    {
        return (!empty($comments)) ?
            new Response(
                $this->templating->render(
                    'ajaxs/comments.html.twig',
                    [
                        "comments" => $comments
                    ]
                )
            ):
            new Response('', Response::HTTP_NOT_FOUND);
    }
}
