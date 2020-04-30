<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\AjaxHomepageResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AjaxHomepageResponder implements AjaxHomepageResponderInterface
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
     * @param array $tricks
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(array $tricks = []): Response
    {
        return (!empty($tricks)) ?
            new Response(
                $this->templating->render(
                    'ajaxs/tricks.html.twig',
                    [
                        "tricks" => $tricks
                    ]
                )
            ):
            new Response('', Response::HTTP_NOT_FOUND);
    }
}
